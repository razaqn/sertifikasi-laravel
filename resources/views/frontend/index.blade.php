@extends('layouts.frontend')

@section('title')
    Departments
@endsection

@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <style>
        .form-control:focus{
            outline: none;
            box-shadow: none;
        }
        a{
            text-decoration: none;
        }
    </style>
@endsection



@section('content')
    <div class="container mx-auto mt-3">

        <div>
            <canvas id="myChart" height="50"></canvas>
        </div>
        <h1 class="text-center mb-3"> Departments </h1>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
            <input type="text" id="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
        </div>

        <div class="mt-2" id="table">
            @foreach ($departments as $department)
            <a href="{{ route('frontend.department', $department->slug) }}">
                <div class="card mb-2">
                    <h5 class="card-title m-3">{{ $department->name }}</h5>
                </div>
            </a>
            @endforeach
        </div>
    </div>
@endsection

@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#table *").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script>
        let labels = 'Departments'
        let array = ["Red", "Blue", "Yellow", "Green", "Purple"]
        console.log(array)
        console.log(labels)
        window.onload = function() {
            let labels = 'Departments'
            var myCanvas = document.getElementById('myChart');
            var ctx = myCanvas.getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [    
                        @foreach ($departments as $name)
                            "{{$name->name}}",
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Departments',
                        data: [ 
                            @foreach ($allcount as $count)
                                "{{$count}}",
                            @endforeach
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }
    </script>
@endsection