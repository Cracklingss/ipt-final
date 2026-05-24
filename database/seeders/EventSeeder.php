<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\EventOrganizer;

class EventSeeder extends Seeder
{
    public function run()
    {
        $org = EventOrganizer::first();
        Event::create([
            'title' => 'Community Hackathon',
            'date' => now()->addWeeks(2)->toDateString(),
            'status' => 'planned',
            'category' => 'Tech',
            'event_organizer_id' => $org ? $org->id : null,
        ]);

        Event::create([
            'title' => 'Design Meetup',
            'date' => now()->addWeeks(1)->toDateString(),
            'status' => 'open',
            'category' => 'Design',
            'event_organizer_id' => $org ? $org->id : null,
        ]);
    }
}
