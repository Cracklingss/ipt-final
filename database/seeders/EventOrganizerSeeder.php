<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventOrganizer;

class EventOrganizerSeeder extends Seeder
{
    public function run()
    {
        EventOrganizer::create(['name' => 'Global Events Co', 'contact' => 'contact@global.co']);
        EventOrganizer::create(['name' => 'Local Meetups', 'contact' => 'hello@local.me']);
    }
}
