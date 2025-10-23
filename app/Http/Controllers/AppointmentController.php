<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Services\TelegramService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function show(): View
    {
        return view('calendar');
    }

    public function store(Request $request, TelegramService $telegram): JsonResponse
    {
        $validated = $request->validate([
            'begin_at' => 'required|date',
            'user_id' => 'nullable|integer',
            'comment' => 'nullable|string|max:500',
        ]);

        $appointment = Appointment::create($validated);

        $message = "Новая запись на консультацию\n\n" .
                    "Время: {$appointment->begin_at}\n" .
                    "User ID: {$appointment->user_id}\n";
                    "Комментарий: {$appointment->comment}\n" .

        $telegram->sendMessage($message);

        return response()->json(['message' => 'Запись создана и уведомление отправлено']);
    }
}
