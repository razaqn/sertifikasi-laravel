@extends('layouts.frontend')

@section('title')
    Employe {{$employe->name}}
@endsection

@section('css')
    <style>
        img{
            object-fit: cover;
            width: 1000px !important;
            height: 600px !important;
        }
    </style>
@endsection

@section('content')
    <div class="container my-3">
        <div class="card mx-auto" style="width: 1000px;">
            <img src="{{ asset('image/employes/'. $employe->image) }}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $employe->fullname }}</h5>
              <h6 class="card-subtitle text-muted">Department {{ $employe->department->name }}</h6>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">{{ $employe->hp }}</li>
              <li class="list-group-item">{!! $employe->cv !!}</li>
              <li class="list-group-item">{!! $employe->address !!}</li>
            </ul>
          </div>
    </div>
@endsection