@extends('layouts.app')

@section('styles')
    <link rel='stylesheet' href='{{ asset('vendor/fullcalendar-5.5.1/main.min.css') }}' />
@endsection

@section('content')

<h1>Assignment Calendar</h1>
Number of assignments: {{ $assignments->count() }}
<br>
Number of assessments: {{ $assessments->count() }}

<div id="calendar"></div>
@endsection

@section('scripts')
    <script src='{{ asset('vendor/fullcalendar-5.5.1/main.min.js') }}'></script>
    <script>
        events = {!! json_encode($events) !!};
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    right: 'dayGridMonth,timeGridWeek,listWeek,timeGridDay today prev,next'
                },
                initialView: 'dayGridMonth',
                weekNumbers: true,
                events: events,
                eventClick: function(info) {
                    info.jsEvent.preventDefault(); // don't let the browser navigate
                    if (info.event.url) {
                        window.open(info.event.url);
                    }
                },
                navLinks: true,
                allDaySlot: false,
                nowIndicator: true,
                showNonCurrentDates: false,
            });
            calendar.setOption('contentHeight', 600);
            calendar.render();
        });

    </script>
@endsection
