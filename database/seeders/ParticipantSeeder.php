<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Participant;
use App\Models\Event;

class ParticipantSeeder extends Seeder
{
    public function run()
    {
        $event = Event::first();
        if ($event) {
            Participant::create(['name' => 'Alice', 'email' => 'alice@example.com', 'event_id' => $event->id]);
            Participant::create(['name' => 'Bob', 'email' => 'bob@example.com', 'event_id' => $event->id]);
        }
    }
}
