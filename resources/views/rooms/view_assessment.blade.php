@extends('layouts.app')

@section('content')
    <h1>Assessment</h1>
    <div class="d-flex">
        Room: {{ $assessment->room->name }}
    </div>
    <div class="d-flex">
        Title: {{ $assessment->title }}
    </div>
    <div class="d-flex">
        Title: {{ $assessment->description }}
    </div>
    <div class="d-flex">
        Deadline: {{ $assessment->deadline }}
    </div>
@endsection
