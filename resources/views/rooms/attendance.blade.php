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
                <th>Verdict</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendance->students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->present_date }}</td>
                    <td>{{ $student->present_time }}</td>
                    <td>
                        @if (strtotime($student->present_time) > strtotime($attendance->expiry_time))
                            Late
                        @else
                            On time
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
@endsection
