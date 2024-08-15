@extends('layouts.app')

@section('title')
    User | Show #ID {{ $item->id }}
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
                    <div class="card-header">User | Show #ID {{ $item->id }}</div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>NAME</th>
                                    <th>:</th>
                                    <td>{{ $item->name }}</td>
                                </tr>
                                <tr>
                                    <th>EMAIL</th>
                                    <th>:</th>
                                    <td>{{ $item->email }}</td>
                                </tr>
                                <tr>
                                    <th>ROLE</th>
                                    <th>:</th>
                                    <td>
                                        @if($item->is_admin)
                                            ADMIN
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('backend.manage.user') }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-arrow-circle-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
