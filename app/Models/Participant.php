<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = ['name', 'email', 'event_id'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function registerEvent(Event $event)
    {
        $this->event()->associate($event);
        $this->save();
        return $this;
    }

    public function cancelEvent()
    {
        $this->event_id = null;
        $this->save();
        return $this;
    }
}
