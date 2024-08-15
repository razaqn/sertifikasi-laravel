@extends('layouts.app')

@section('title')
    Employe | Show #ID {{ $item->id }}
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script>
        $(function(){
            $('[data-fancybox]').fancybox();
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Employe | Show #ID {{ $item->id }}</div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>IMAGE</th>
                                    <th>:</th>
                                    <td><img width="300" src="{{ asset('image/employes/'. $item->image) }}" alt="" class="img-thumbnail"></td>
                                </tr>
                                <tr>
                                    <th>DEPARTMENT</th>
                                    <th>:</th>
                                    <td>{{ $item->department->name }}</td>
                                </tr>
                                <tr>
                                    <th>FULLNAME</th>
                                    <th>:</th>
                                    <td>{{ $item->fullname }}</td>
                                </tr>
                                <tr>
                                    <th>SLUG</th>
                                    <th>:</th>
                                    <td>{{ $item->slug }}</td>
                                </tr>
                                <tr>
                                    <th>HP</th>
                                    <th>:</th>
                                    <td>{{ $item->hp }}</td>
                                </tr>
                                <tr>
                                    <th>CV</th>
                                    <th>:</th>
                                    <td>{{ $item->cv }}</td>
                                </tr>
                                <tr>
                                    <th>ADDRESS</th>
                                    <th>:</th>
                                    <td>{{ $item->address }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('backend.manage.employe') }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-arrow-circle-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
