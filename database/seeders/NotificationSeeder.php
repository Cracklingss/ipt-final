<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\Event;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        $event = Event::first();
        if ($event) {
            Notification::create(['event_id' => $event->id, 'message' => 'Reminder: event coming soon', 'date_sent' => now()]);
        }
    }
}
