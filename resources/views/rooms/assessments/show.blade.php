@extends('layouts.app')

@section('content')
    <h1>Assessment for {{ $assessment->title }} from {{ $assessment->room->name }}</h1>

    <p>{{ $assessment->description }}</p>

    <h3>Students Score</h3>
    <div class="d-flex">

        <table style="width: 30vw">
            <tr>
                <th>Rank</th>
                <th>Name of Student</th>
                <th>Score</th>
                <th>Percentile</th>
            </tr>
            @foreach ($assessment->studentList as $student)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $student->name }}</td>
                <td class="text-center">{{ $student->score }}</td>
                <td class="text-center"> X </td>
            </tr>
            @endforeach
        </table>

        <div style="position: relative; height:50vh; width:60vw">
            <canvas id="chart"></canvas>
        </div>
    </div>
    <canvas id="test"></canvas>
@endsection

@section('scripts')
<script>
    var ctx = document.getElementById('chart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Number of Students',
                backgroundColor: {!! json_encode($colors) !!},
                borderColor: {!! json_encode($colors) !!},
                data: {!! json_encode($data) !!}
            }]
        },

        // Configuration options go here
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                position: 'bottom',
                text: 'Student Score Chart',
            },
            legend: {
                display: false,
            },
            scales: {
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'No. of students',
                    },
                    ticks: {
                        beginAtZero: true,
                        max: {{ $assessment->student_list->count() }},
                        stepSize: 1,
                    },
                }],
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Score range'
                    },
                }]
            }
        }
    });
</script>

<script>
    var testx = document.getElementById('test').getContext('2d');
    var test_chart = new Chart(testx, {
        type: 'line',
        data: {
            labels: {!! json_encode($sortedKeys) !!},
            datasets: [{
                label: 'Number of Students',
                data: {!! json_encode($sortedValues) !!}
            }]
        },
        options: {
            scales: {

                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                    },
                }],
            }

        },
    });
</script>

@endsection
