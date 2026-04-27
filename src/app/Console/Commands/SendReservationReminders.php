<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use App\Models\Reservation;
use App\Mail\ReminderMail;
use Carbon\Carbon;

class SendReservationReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $reservations = Reservation::whereDate('date', Carbon::now())->whereNull('reminder_sent_at')->get();
        // 今日予約があってまだ送ってない人を連れてくる

        $this->info('見つかった予約件数: ' . $reservations->count());

        foreach ($reservations as $reservation) {
            $this->info($reservation->user->email . ' さんへ送信中...');

            Mail::to($reservation->user->email)->send(new ReminderMail($reservation));
            // 予約に紐づくユーザーのメアドを送る

            $reservation->update(['reminder_sent_at' => now()]);
        }// 送った時間を記録する（二重送信防止）

        $this->info('リマインダーを送信しました');
        return 0;
    }
}
