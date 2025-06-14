<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            [
                'nomor_lapangan' => 1,
                'jam_mulai' => '09:00',
                'jam_selesai' => '11:00',
            ],
            [
                'nomor_lapangan' => 1,
                'jam_mulai' => '11:00',
                'jam_selesai' => '13:00',
            ],
            [
                'nomor_lapangan' => 1,
                'jam_mulai' => '13:00',
                'jam_selesai' => '15:00',
            ],
            [
                'nomor_lapangan' => 1,
                'jam_mulai' => '15:00',
                'jam_selesai' => '17:00',
            ],
            [
                'nomor_lapangan' => 1,
                'jam_mulai' => '17:00',
                'jam_selesai' => '19:00',
            ],
            [
                'nomor_lapangan' => 1,
                'jam_mulai' => '19:00',
                'jam_selesai' => '21:00',
            ],
            [
                'nomor_lapangan' => 1,
                'jam_mulai' => '21:00',
                'jam_selesai' => '23:00',
            ],
            [
                'nomor_lapangan' => 2,
                'jam_mulai' => '09:00',
                'jam_selesai' => '11:00',
            ],
            [
                'nomor_lapangan' => 2,
                'jam_mulai' => '11:00',
                'jam_selesai' => '13:00',
            ],
            [
                'nomor_lapangan' => 2,
                'jam_mulai' => '13:00',
                'jam_selesai' => '15:00',
            ],
            [
                'nomor_lapangan' => 2,
                'jam_mulai' => '15:00',
                'jam_selesai' => '17:00',
            ],
            [
                'nomor_lapangan' => 2,
                'jam_mulai' => '17:00',
                'jam_selesai' => '19:00',
            ],
            [
                'nomor_lapangan' => 2,
                'jam_mulai' => '19:00',
                'jam_selesai' => '21:00',
            ],
            [
                'nomor_lapangan' => 2,
                'jam_mulai' => '21:00',
                'jam_selesai' => '23:00',
            ],
        ];

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }
    }
}
