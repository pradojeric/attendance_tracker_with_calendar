@extends('layouts.app')

@section('styles')
    <link rel='stylesheet' href='{{ asset('vendor/fullcalendar-5.5.1/main.min.css') }}' />
@endsection

@section('content')

<h1>Todos</h1>

<h2>Upcoming</h2>
<h5>Todos: {{ $todos->count() }}</h5>
<table class="table">
    @foreach($todos as $todo)
        <tr class="@if($todo['done']) text-success @endif">
            <td width="30%">{{ $todo['room'] }}: {{ $todo['prefix'] }}</td>
            <td>
                <ul class="list-unstyled">
                    <li>Title: <a href="{{ $todo['url'] }}">{{ $todo['title'] }}</a></li>
                    <li>Description: {{ $todo['description'] }}</li>
                    <li><b>Deadline: {{ date('h:i a, M d, Y',strtotime($todo['deadline'])) }}</b></li>
                </ul>
            </td>
        </tr>
    @endforeach
</table>


<h2>History</h2>
<table class="table">
    @foreach($recents as $recent)
        <tr class="@if($recent['done']) text-success @endif">
            <td width="30%">{{ $recent['room'] }}: {{ $recent['prefix'] }}</td>
            <td>
                <ul class="list-unstyled">
                    <li>Title: <a href="{{ $recent['url'] }}">{{ $recent['title'] }}</a></li>
                    <li>Description: {{ $recent['description'] }}</li>
                    <li><b>Deadline: {{ date('h:i a, M d, Y',strtotime($recent['deadline'])) }}</b></li>
                </ul>
            </td>
        </tr>
    @endforeach
</table>

@endsection


