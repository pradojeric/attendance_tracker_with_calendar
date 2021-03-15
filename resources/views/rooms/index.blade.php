@extends('layouts.app')

@section('content')
    <ul>
        @foreach($rooms as $room)
            @if(Gate::check('teacher-only', $room) || Gate::check('student-only', $room))
                <li><a href="{{ route('rooms.show', $room) }}">{{ $room->name }}</a></li>
            @endif
        @endforeach
    </ul>

    <a href="{{ route('logout') }}"
        onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
@endsection
