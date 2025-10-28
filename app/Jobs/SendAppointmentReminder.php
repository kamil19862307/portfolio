<?php

namespace App\Jobs;

use App\Models\Appointment;
use App\Services\TelegramService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendAppointmentReminder implements ShouldQueue
{
    use Queueable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Appointment $appointment)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(TelegramService $telegram): void
    {
        $text = "Напоминание, встреча запланирована на: {$this->appointment->begin_at}.\n" .
                "Комментарий: {$this->appointment->comment}.";

        $telegram->sendMessage($text);

        $this->appointment->update(['is_sent' => 1]);
    }
}
