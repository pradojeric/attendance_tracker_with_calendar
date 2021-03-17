@extends('layouts.app')

@section('content')
    <h1>Assessment for {{ $assessment->title }}</h1>

    <h3>Students Score</h3>

    @foreach ($assessment->room->students as $student)
        <ul>
            <li>{{ $student->name }} // Scores: {{ $student->finishedAssessments->where('pivot.assessment_id', $assessment->id)->pluck('pivot.score') }}</li>
        </ul>
    @endforeach
@endsection
