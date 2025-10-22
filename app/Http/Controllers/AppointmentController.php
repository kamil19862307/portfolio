<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Services\TelegramService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function show(): View
    {
        return view('calendar');
    }

    public function store(Request $request, TelegramService $telegram)
    {
        $validated = $request->validate([
            'begin_at' => 'required|date',
            'user_id' => 'nullable|integer',
        ]);

        $appointment = Appointment::create($validated);

        $message = "Новая запись на конысультацию\n\n" .
                    "Время: {$appointment->begin_at}\n" .
                    "User ID: {$appointment->user_id}\n";

        $telegram->sendMessage($message);

        return response()->json(['message' => 'Запиись создана и уведомление отправлено']);
    }
}
