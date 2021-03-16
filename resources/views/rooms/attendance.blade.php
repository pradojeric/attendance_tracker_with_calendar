@extends('layouts.app')

@section('content')
    <h1>Attendance tracker</h1>
    Schedule: {{ $attendance->schedule->schedule_time }}<br>
    Attendance Date: {{ $attendance->attendance_date }}<br>
    Expiry: {{ $attendance->expiry_time }}
    <table class="table">
        <thead>
            <tr>
                <th>Name of Student</th>
                <th>Attendance Present</th>
                <th>Attendance Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendance->students as $student)
                <tr class="@if($student->isLate($attendance)) text-danger @endif">
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->present_date }}</td>
                    <td>{{ $student->present_time }}</td>
                    <td>@if($student->isLate($attendance)) Late @else On time @endif</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
