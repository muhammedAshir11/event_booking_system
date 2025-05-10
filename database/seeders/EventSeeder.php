<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Insert sample enent data to database
        Event::insert([
            [
                'name' => 'Sunburn Music Event 2025',
                'venue' => 'Delhi Convention Center',
                'event_date' => Carbon::now()->addDays(10),
                'total_seats' => 100,
                'available_seats' => 100,
                'ticket_price' => 2000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tomorrowland Music Event 2025',
                'venue' => 'Mumbai Tech Park',
                'event_date' => Carbon::now()->addDays(20),
                'total_seats' => 150,
                'available_seats' => 150,
                'ticket_price' => 4000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Startup Meetup',
                'venue' => 'Bangalore Innovation Hub',
                'event_date' => Carbon::now()->addDays(30),
                'total_seats' => 80,
                'available_seats' => 80,
                'ticket_price' => 299.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
