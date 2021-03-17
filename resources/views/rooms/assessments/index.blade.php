@extends('layouts.app')

@section('content')
    <h1>Assessments</h1>

    @foreach ($room->assessments as $assessment)
        <ul>
            <li><a href="/assessment/{{ $assessment->id }}">{{ $assessment->title }}</a></li>
        </ul>
    @endforeach
@endsection
