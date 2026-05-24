<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    protected $fillable = ['title', 'date', 'status', 'category', 'event_organizer_id'];

    public function organizer()
    {
        return $this->belongsTo(EventOrganizer::class, 'event_organizer_id');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function updateStatus(string $status)
    {
        $this->status = $status;
        $this->save();
    }

    public function getParticipants()
    {
        return $this->participants()->get();
    }

    public function getComputedStatusAttribute(): string
    {
        $today = Carbon::today();
        $eventDate = Carbon::parse($this->date)->startOfDay();

        if ($eventDate->gt($today)) {
            return 'Upcoming';
        }

        if ($eventDate->eq($today)) {
            return 'Ongoing';
        }

        return 'Done';
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return strtolower($this->computed_status);
    }
}
