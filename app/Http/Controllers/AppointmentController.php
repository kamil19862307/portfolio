<?php

namespace App\Http\Controllers;

use App\Jobs\SendAppointmentReminder;
use App\Models\Appointment;
use App\Services\TelegramService;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    public function show(): View
    {
        $appointments = Appointment::query()
                            ->select(['begin_at'])
                            ->where('is_sent', '=', 0)
                            ->get();

        // Для подсветки дня
        $events = $appointments
            ->pluck('begin_at')
            ->map(function ($a) {
                $date = Carbon::parse($a)->setTimezone('Europe/Moscow');

                return $date->format('Y-m-d');

            })
            ->unique()
            ->values()
            ->all();

        $busyRaw = $appointments->map(function ($a) {

            $date = Carbon::parse($a->begin_at)->setTimezone('Europe/Moscow');

            // toIso8601String даёт "+00:00" — заменим на Z для единообразия
            $iso = $date->toIso8601String();

            return preg_replace('/\+00:00$/', 'Z', $iso);

        })->values()->all();

        return view('calendar', compact('events', 'busyRaw'));
    }

    public function store(Request $request, TelegramService $telegram): JsonResponse
    {
        $validated = $request->validate([
            'begin_at' => 'required|date|unique:appointments,begin_at',
            'user_id' => 'nullable|integer',
            'comment' => 'nullable|string|max:500',
        ]);

        DB::beginTransaction();
        try {
            $appointment = Appointment::create($validated);

            DB::commit();

            //После успешного коммита, выполняем остальные действия
            $message = "Новая запись на консультацию\n\n" .
                "Время: {$appointment->begin_at}\n" .
                "User ID: " . ($appointment->user_id ?? 'Гость') . "\n" .
                "Комментарий: " . ($appointment->comment ?: 'Без комментария');

            try {
                $telegram->sendMessage($message);

            }catch (\Throwable $exception){
                Log::error('Не удалось отправить сообщение в телеграм, appointment ID: ' . $appointment->id,
                ['exception' => $exception->getMessage()]);
            }

            // Расчёт времени для отложенной отправки за 2 минуты до начала
            $sendAt = Carbon::parse($appointment->begin_at)->subMinutes(2);

            SendAppointmentReminder::dispatch($appointment)->delay($sendAt);

            return response()->json([
                'message' => 'Запись создана и уведомление отправлено',
                'appointment' => $appointment
            ], 201);

        }catch (\Throwable $exception){
            DB::rollBack();

            Log::error('Не получилось создать запись встречи в Базе Данных.', [
                'error' => $exception->getMessage(),
                'payload' => $validated
            ]);

            return response()->json([
                'message' => 'Не удалось создать запись',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
