@extends('layouts.app')

@section('content')
    @foreach($errors->all() as $error)
        {{ $error }}
    @endforeach
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @endif
    <h1>{{ $room->name }}</h1>
    <h2>Teacher: {{ $room->teacherName }}</h2>

    @can('teacher-only', $room)
        <h4>Attendance:</h4>
        <form method="post" action="{{ route('add_attendance') }}">
            @csrf
            <div class="form-group row">
                <label for="schedule" class="col-sm-3 col-form-label">Select Schedule:</label>
                <select name="schedule" class="form-control col-sm @error('schedule') is-invalid @enderror" id="schedule">
                    <option selected hidden disabled>...</option>
                    @foreach($room->schedules as $schedule)
                    <option value="{{ $schedule->id }}">{{ $schedule->schedule_time }}</option>
                    @endforeach
                </select>
            </div>
            @error('schedule')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group row">
                <label for="date" class="col-sm-3 col-form-label">
                    Date:
                </label>
                <input type="date" name="attendance_date" value="{{ date('Y-m-d') }}" class="form-control col-sm @error('attendance_date') is-invalid @enderror" id="date">

            </div>
            @error('attendance_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            <div class="form-group row">
                <label for="expiry_time" class="col-sm-3 col-form-label">
                    Expire Time:
                </label>
                <input type="time" name="expiry_time" value="{{ date('H:i', strtotime('+10 minutes')) }}" class="form-control col-sm @error('expiry_time') is-invalid @enderror" id="expiry_time">
            </div>
            @error('expiry_time')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            <div class="form-group row">
                <label for="description" class="col-sm-3 col-form-label">
                    Description:
                </label>
                <input type="text" value="Attendance" name="description" class="form-control col-sm @error('description') is-invalid @enderror" id="description">
            </div>
            @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            <div class="row">
                <button type="submit" class="btn btn-primary btn-sm col-auto ml-auto">Add Attendance</button>
            </div>
        </form>
        <br>
        <a href="/rooms/{{ $room->id }}/assessments" class="btn btn-info btn-sm">View Assessments</a>
        <form action="/emailNotify/{{$room->id}}" method="post">
            @csrf
            <button type="button" class="btn btn-success btn-sm" id="notify_students">Notify Students on Assignments</button>
        </form>
    @endcan
    <h3>Attendances</h3>
    @can('teacher-only', $room)
        <div class="form-group row">
            <label for="a_date" class="col-sm-2 col-form-label">
                Date:
            </label>
            <input type="date" id="a_date" value="{{ date('Y-m-d') }}" class="form-control col-sm-4">
            <div class="col-sm-auto">
                <button type="button" id="date_select" class="btn btn-primary">Select</button>
            </div>
            <div class="col-sm-auto">
                <button type="button" id="date_clear" class="btn btn-danger">Clear</button>
            </div>
        </div>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Schedule</th>
                    <th>Description</th>
                    <th>Created</th>
                    <th>Expiration</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="attend">

            </tbody>
        </table>
        <form action="#" method="post" id="att_form">
            @csrf
            @method('put')
        </form>
    @elsecan('student-only', $room)
        <table class="table table-sm">
            <tr>
                <th>Date</th>
                <th>Schedule</th>
                <th>Description</th>
                <th>Created</th>
                <th>Expiration</th>
                <th>Action</th>
            </tr>
                <tbody class="attend">

                </tbody>
        </table>
        <form action="#" method="post" id="att_form">
            @csrf
        </form>
    @endcan
@endsection

@section('scripts')

    @can('teacher-only', $room)
        <script>

            getAttendances();

            function getAttendances(date = null)
            {
                var url = "{{ url('/attendance/get/') }}/" + {{ $room->id }} + "/";
                var _token = '{{ csrf_token() }}';
                $('.attend').empty();
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {date: date, _token: _token},
                    success: function(data){
                        console.log(data);
                        $('.attend').append(data);
                    }
                });
            }

            $(document).on('click', '.attendance', function(event){
                event.preventDefault();
                var row_id = $(this).closest('tr').attr('id');
                console.log(row_id);

                var url = "{{ url('/attendance/update/') }}/" + row_id;
                $('#att_form').attr('action', url);
                $('#att_form').submit();
            });

            $(document).on('click', '.attendance_delete', function(event){
                event.preventDefault();
                var row_id = $(this).closest('tr').attr('id');
                var url = "{{ url('/attendance/delete/') }}/" + row_id;

                $('#att_form').attr('action', url);
                $('#att_form').append('@method("delete")');
                $('#att_form').submit();
            });

            $(document).on('click', '.attendance_view', function(event){
                event.preventDefault();
                var row_id = $(this).closest('tr').attr('id');
                var url = "{{ url('/attendance/view/') }}/" + row_id;

                window.open(url);
            });

            $('#notify_students').click(function(event){
                $(this).attr('disabled', true);
                $(this).closest('form').submit();
                $(this).after('Sending');
            });

            $('#date_select').click(function(event){
                event.preventDefault();
                var date = $('#a_date').val();
                getAttendances(date);
            });

            $('#date_clear').click(function(event){
                event.preventDefault();
                getAttendances();
            });

        </script>
    @endcan

    @can('student-only', $room)
        <script>
            getStudentAttendances();

            function getStudentAttendances()
            {
                var url = "{{ url('/show/attendance/') }}/" + {{ $room->id }} + "/";
                var _token = '{{ csrf_token() }}';
                $('.attend').empty();
                $.ajax({
                    url: url,
                    success: function(data){
                        console.log(data);
                        $('.attend').append(data);
                    }
                });
            }

            $(document).on('click', '.present', function(event){
                event.preventDefault();
                var row_id = $(this).closest('tr').attr('id');
                var url = "{{ url('/attend/') }}/" + row_id;

                $('#att_form').attr('action', url);
                $('#att_form').submit();
            });
        </script>
    @endcan

@endsection
