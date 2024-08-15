@extends('layouts.frontend')

@section('title')
    Department {{$department->name}}
@endsection

@section('css')
    <style>
        .form-control:focus{
            outline: none;
            box-shadow: none;
        }
        img{
            object-fit: cover;
            width: 500px;
            height: 300px !important;
        }
    </style>
@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
        $("#search").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#table .card").each(function () {
                var card = $(this);
                if (card.text().toLowerCase().indexOf(value) > -1) {
                    card.show();
                } else {
                    card.hide();
                }
            });
        });
    });
    </script>
@endsection

@section('content')
    <div class="container mx-auto mt-3">
        <h1 class="text-center mb-3"> Department {{$department->name}} </h1>

        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
            <input type="text" id="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
        </div>

        <div class="mt-2" id="table">
            @foreach ($employes as $employe)
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('image/employes/'. $employe->image) }}" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $employe->fullname }}</h5>
                                <p class="card-text">{{ $employe->cv }}</p>
                                <a href="{{ route('frontend.employe', $employe->slug) }}" class="btn btn-primary">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection