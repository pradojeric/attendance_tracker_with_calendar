<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
    protected $guarded = [];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'attendance_students', 'attendance_id', 'student_id')->as('attendance')->withTimestamps();
    }

    public function getCreatedDateAttribute()
    {
        return date('l, m-d-Y', strtotime($this->created_at));
    }

    public function getAttendanceDateAttribute($value)
    {
        return date('m-d-Y', strtotime($value));
    }

    public function getExpiryTimeAttribute($value)
    {
        return date('h:i A', strtotime($value));
    }


}
