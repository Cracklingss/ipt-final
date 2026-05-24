<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['event_id', 'message', 'date_sent'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function sendReminder()
    {
        // Minimal stub: record date_sent and keep for audit. Integration with real mail/sms
        $this->date_sent = now();
        $this->save();
        return $this;
    }
}
