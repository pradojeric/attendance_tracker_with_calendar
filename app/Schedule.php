<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    protected $guarded = [];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function getScheduleTimeAttribute()
    {
        return $this->day." ".date('h:i A', strtotime($this->start_class))." - ".date('h:i A', strtotime($this->end_class));
    }

}
