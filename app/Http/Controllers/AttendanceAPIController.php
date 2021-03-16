<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Http\Resources\Attendance as AttendanceResource;
use Illuminate\Http\Request;

class AttendanceAPIController extends Controller
{
    //
    public function index()
    {
        $attendances = Attendance::orderBy('created_at', 'desc')->get();
        return AttendanceResource::collection($attendances);
    }
}
