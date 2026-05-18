<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SHop;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reservation::create([
            'user_id' => 1,
            'shop_id' => 1,
            'date' => '2026-05-10',
            'time' => '19:00:00',
            'number' => 2,
            'checked_in' => '2026-05-10 19:00:00',
            'reminder_sent_at' => '2026-05-10 08:00:00',
            'is_paid' => true,
        ]);
    }
}
