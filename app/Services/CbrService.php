<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use SimpleXMLElement;

class CbrService
{

    protected  string $url = 'https://www.cbr.ru/scripts/XML_daily.asp';

    // Можно передать дату в формате dd.MM.yyyy, либо не передавать — вернёт текущую дату ЦБ
    // ожидаем dd.MM.yyyy, например 16.11.2025
    protected string $date = '';

    protected int $timeout = 10;

    // На один час закешировать результат, чтобы часто не дёргать Центрбанк
    protected int $cacheTtlSeconds = 3600;

    /**
     * Возвращает массив ['date' => 'dd.MM.yyyy', 'currency' => 'USD', 'rate' => float ]
     *
     * @param string|null $date формат 'dd.MM.yyyy', либо null (текущая дата ЦБ)
     *
     * @retrun array
     *
     * @throws \RuntimeException в случае ошибки
     */

    public function getUsd(?string $date = null): array
    {
        // Если в кеше есть массив с данными курса, то возвращаем его же
        if(Cache::has('cbrArray')){
            return Cache::get('cbrArray');
        }

        $cacheKey = 'cbr_cache_' . ($date ?? 'today');

        $xml = $this->fetchAndParseXml($date);

        $dateAttribute = (string) ($xml['Date'] ?? ($date ?? ''));

        // Парсим xml
        foreach ($xml->Valute as $valute) {
            if ((string) $valute->CharCode === 'USD') {
                $nominal = (int) $valute->Nominal;
                $valueText = (string) $valute->Value; // пример: "80,45"
                $value = (float) str_replace(',', '.', $valueText);
                $rate = $nominal > 1 ? $value / $nominal : $value;

                $currencyArray = [
                    'date' => $dateAttribute,
                    'currency' => 'USD',
                    'rate' => round($rate, 6),
                ];

                // Закешируем, чтобы часто не обращаться к сервису центбанка, всё равно курс на день выставляется.
                Cache::put('cbrArray', $currencyArray, now()->addMinutes(60));

                return $currencyArray;
            }
        }

        throw new \RuntimeException();
    }


    /**
     * Выполняет Http запрос и возвращает SimpleXMLElement
     *
     * @param string|null $date
     *
     * @return SimpleXMLElement
     *
     * @throws \RuntimeException
     */
    protected function fetchAndParseXml(?string $date = null): simpleXMLElement
    {
        $params = $date ? ['Date' => $date] : [];

        $response = Http::withHeaders([
            'User-Agent' => 'MyApp/1.0 (Laravel)',
            'Accept' => 'application/xml,text/xml'
        ])->timeout(10)
            ->post($this->url, $params);

        if (! $response->successful()) {
            Log::warning('CBR request failed', ['status' => $response->status()]);
            throw new \RuntimeException('Sbr request failed', $response->status());
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

        libxml_use_internal_errors(true);

        $xml = simplexml_load_string($raw);

        if ($xml === false) {
            $errors = libxml_get_errors();
            $msg = [];
            foreach ($errors as $error) {
                $msg[] = $error->message . "{Line $error->line}, column $error->column}";
            }

            libxml_clear_errors();

            Log::error('CBR XML parse failed', ['error' => $msg]);

            throw new \RuntimeException('XML parse error' . implode(' ', $msg));
        }

        return $xml;
    }
}



