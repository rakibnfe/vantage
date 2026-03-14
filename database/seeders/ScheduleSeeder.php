<?php
// database/seeders/ScheduleSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Offering;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $offerings = Offering::all();

        // Availability (working hours)
        $availabilities = [
            [
                'title' => 'Morning Availability',
                'type' => 'availability',
                'start_time' => Carbon::today()->setTime(9, 0),
                'end_time' => Carbon::today()->setTime(12, 0),
                'color' => '#10b981',
            ],
            [
                'title' => 'Afternoon Availability',
                'type' => 'availability',
                'start_time' => Carbon::today()->setTime(13, 0),
                'end_time' => Carbon::today()->setTime(17, 0),
                'color' => '#10b981',
            ],
            [
                'title' => 'Extended Hours',
                'type' => 'availability',
                'start_time' => Carbon::tomorrow()->setTime(10, 0),
                'end_time' => Carbon::tomorrow()->setTime(19, 0),
                'color' => '#10b981',
            ],
        ];

        foreach ($availabilities as $data) {
            Schedule::create(array_merge($data, [
                'slug' => 'availability-' . uniqid(),
                'status' => 'scheduled',
                'user_id' => $users->random()->id,
            ]));
        }

        // Appointments
        $appointments = [
            [
                'title' => 'Consultation Call',
                'type' => 'appointment',
                'status' => 'confirmed',
                'start_time' => Carbon::today()->setTime(10, 0),
                'end_time' => Carbon::today()->setTime(11, 0),
                'customer_name' => 'John Doe',
                'customer_email' => 'john@example.com',
                'customer_phone' => '+1234567890',
                'customer_notes' => 'Interested in web development offerings',
                'color' => '#4f46e5',
            ],
            [
                'title' => 'Project Kickoff',
                'type' => 'appointment',
                'status' => 'scheduled',
                'start_time' => Carbon::tomorrow()->setTime(14, 0),
                'end_time' => Carbon::tomorrow()->setTime(15, 30),
                'customer_name' => 'Jane Smith',
                'customer_email' => 'jane@example.com',
                'customer_phone' => '+0987654321',
                'customer_notes' => 'Need to discuss mobile app requirements',
                'color' => '#4f46e5',
            ],
            [
                'title' => 'Design Review',
                'type' => 'appointment',
                'status' => 'completed',
                'start_time' => Carbon::yesterday()->setTime(15, 0),
                'end_time' => Carbon::yesterday()->setTime(16, 0),
                'customer_name' => 'Mike Johnson',
                'customer_email' => 'mike@example.com',
                'color' => '#4f46e5',
            ],
        ];

        foreach ($appointments as $data) {
            Schedule::create(array_merge($data, [
                'slug' => 'appointment-' . uniqid(),
                'user_id' => $users->random()->id,
                'offering_id' => $offerings->isNotEmpty() ? $offerings->random()->id : null,
            ]));
        }

        // Blocked times (lunch, meetings, etc.)
        $blocked = [
            [
                'title' => 'Lunch Break',
                'type' => 'blocked',
                'start_time' => Carbon::today()->setTime(12, 0),
                'end_time' => Carbon::today()->setTime(13, 0),
                'color' => '#ef4444',
            ],
            [
                'title' => 'Team Meeting',
                'type' => 'blocked',
                'start_time' => Carbon::tomorrow()->setTime(11, 0),
                'end_time' => Carbon::tomorrow()->setTime(12, 0),
                'color' => '#ef4444',
            ],
            [
                'title' => 'Training Session',
                'type' => 'blocked',
                'is_recurring' => true,
                'recurrence_pattern' => 'weekly',
                'recurrence_days' => ['wednesday'],
                'recurrence_until' => Carbon::now()->addMonths(3),
                'start_time' => Carbon::now()->next('Wednesday')->setTime(15, 0),
                'end_time' => Carbon::now()->next('Wednesday')->setTime(17, 0),
                'color' => '#ef4444',
            ],
        ];

        foreach ($blocked as $data) {
            Schedule::create(array_merge($data, [
                'slug' => 'blocked-' . uniqid(),
                'user_id' => $users->random()->id,
            ]));
        }
    }
}