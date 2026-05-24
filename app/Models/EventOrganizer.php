<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventOrganizer extends Model
{
    protected $fillable = ['name', 'contact'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }
}
