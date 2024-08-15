@extends('layouts.app')

@section('title')
    Product | Create
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        .select2-container .select2-selection--single { height: 37px; font-size: .875rem; }
        .select2-container--default .select2-selection--single .select2-selection__rendered { line-height: 37px; }
        .select2-container--default .select2-selection--single .select2-selection__arrow { height: 37px; }
        .select2-container--default .select2-selection--single { border-radius: 0.375rem; border: 1px solid #ced4da; }
        .select2-container--default .select2-results__option--selected { font-size: .875rem; }
        .select2-results__option--selectable { font-size: .875rem;}
    </style>
@endsection

@section('javascript')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function(){
            $('select').select2();
        })
    </script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Product | Create') }}</div>
                <div class="card-body">
                    <form id="contactForm" action="{{ route('backend.create.process.product') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">

                                <div class="mb-3">
                                    <div class="mb-2 @error('name') text-danger fw-bold @enderror">Name:</div>
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" 
                                    class="form-control @error('name') text-danger is-invalid @enderror">
                                    @error('name')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 @error('id_category') text-danger fw-bold @enderror">Category:</div>
                                    <select class="form-control" name="id_category">
                                        <option value="">Pilih Category</option>
                                        <option value="1">Baru</option>
                                        <option value="2">Bekas</option>
                                    </select>
                                    @error('id_category')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <button class="btn btn-dark">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection