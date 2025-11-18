<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    public function show()
    {

        $url = 'https://www.cbr.ru/scripts/XML_daily.asp';
        // Можно передать дату в формате dd.MM.yyyy, либо не передавать — вернёт текущую дату ЦБ
        $date = ''; // ожидаем dd.MM.yyyy, например 16.11.2025

        $response = Http::withHeaders([
            'User-Agent' => 'MyApp/1.0 (Laravel)',
            'Accept' => 'application/xml,text/xml'
        ])->timeout(10)
          ->post($url, $date ? ['date_req' => $date] : []);

        if (! $response->successful()) {
            Log::warning('CBR request failed', ['status' => $response->status()]);
            return response()->json(['error' => 'CBR request failed'], 502);
        }

        // Получаем "сырые" байты и декодируем cp1251 -> UTF-8
        $bodyBytes = $response->body(); // Laravel автоматически декодирует в строку, но может быть уже в UTF-8
        // На всякий случай убедимся, что строка в UTF-8, перекодировав из CP1251 если нужно
        if (! mb_detect_encoding($bodyBytes, 'UTF-8', true)) {
            $xmlString = mb_convert_encoding($bodyBytes, 'UTF-8', 'CP1251');
        } else {
            $xmlString = $bodyBytes;
        }

        // 1) Удаляем BOM если есть
        $raw = preg_replace('/^\xEF\xBB\xBF/', '', $xmlString);

        // 2) Убираем невалидные управляющие символы, кроме \t \n \r
        $raw = preg_replace('/[^\x09\x0A\x0D\x20-\x{10FFFF}]/u', '', $raw);

        // 3) Если в декларации явно указана windows-1251 — перекодируем в UTF-8
        if (preg_match('/<\?xml[^>]*encoding=["\']?windows-1251["\']?/i', $raw)) {
            // Перекодируем из CP1251 -> UTF-8
            $raw = mb_convert_encoding($raw, 'UTF-8', 'CP1251');
            // Обновим декларацию чтобы она соответствовала реальной кодировке
            $raw = preg_replace('/(<\?xml[^>]*encoding=["\']?)windows-1251(["\']?[^>]*\?>)/i', '$1UTF-8$2', $raw);
        } else {
            // Если декларация отсутствует или другая — попытка привести к UTF-8 на всякий случай
            if (! mb_detect_encoding($raw, 'UTF-8', true)) {
                $raw = mb_convert_encoding($raw, 'UTF-8', 'CP1251');
            }
        }

        // Парсим XML
        try {
            $xml = simplexml_load_string($raw);

            if ($xml === false) {
                throw new \Exception('XML parse error');
            }
        } catch (\Throwable $e) {
            Log::error('CBR XML parse failed', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to parse CBR response'], 502);
        }

        // Ищем блок Valute с CharCode == USD
        $usdRate = null;
        foreach ($xml->Valute as $valute) {
            if ((string) $valute->CharCode === 'USD') {
                $nominal = (int) $valute->Nominal;
                $valueText = (string) $valute->Value; // пример: "80,45"
                $value = (float) str_replace(',', '.', $valueText);
                if ($nominal > 1) {
                    $usdRate = $value / $nominal;
                } else {
                    $usdRate = $value;
                }
                break;
            }
        }

        if ($usdRate === null) {
            Log::warning('USD not found in CBR response');
            return response()->json(['error' => 'USD not found'], 404);
        }

        return response()->json([
            'date' => (string) $xml['Date'] ?? $date,
            'currency' => 'USD',
            'rate' => round($usdRate, 6) // за 1 USD
        ]);
    }
}
