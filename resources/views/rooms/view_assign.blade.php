@extends('layouts.app')

@section('content')
    <h1>Assignment</h1>
    <div class="d-flex">
        Room: {{ $assignment->room->name }}
    </div>
    <div class="d-flex">
        Title: {{ $assignment->title }}
    </div>
    <div class="d-flex">
        Description: {{ $assignment->description }}
    </div>
    <div class="d-flex">
        Deadline: {{ $assignment->deadline }}
    </div>
@endsection
