<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ['name', 'email', 'event_organizer_id'];

    public function organizer()
    {
        return $this->belongsTo(EventOrganizer::class, 'event_organizer_id');
    }

    public function createEvent(array $data)
    {
        return Event::create($data);
    }

    public function editEvent(Event $event, array $data)
    {
        $event->update($data);
        return $event;
    }

    public function deleteEvent(Event $event)
    {
        return $event->delete();
    }
}
