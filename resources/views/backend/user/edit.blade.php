@extends('layouts.app')

@section('title')
    User | Edit
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User | Update') }}</div>
                <div class="card-body">
                    <form id="contactForm" 
                    @if (Auth::User()->id == $item->id)
                        action="{{ route('backend.edit.process.user.me') }}"
                    @endif
                    @if (Auth::User()->id != $item->id)
                        action="{{ route('backend.edit.process.user') }}"
                    @endif
                    method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <input type="hidden" value="{{$item->id}}" name="id">

                                <div class="mb-3">
                                    <div class="mb-2 @error('name') text-danger fw-bold @enderror">Name:</div>
                                    <input type="text" name="name" value="{{ $item->name }}" placeholder="Name" 
                                    class="form-control @error('name') text-danger is-invalid @enderror">
                                    @error('name')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 @error('email') text-danger fw-bold @enderror">Email</div>
                                    <input type="email" name="email" value="{{ $item->email  }}" placeholder="Email" 
                                    class="form-control @error('email') text-danger is-invalid @enderror">
                                    @error('email')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>
                                
                                @if(!$edit_me)
                                <div class="mb-3">
                                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                        <input type="checkbox" class="btn-check" id="btncheck1" @if ($item->is_admin) checked @endif 
                                        autocomplete="off" value="1" name="is_admin">
                                        <label class="btn btn-outline-primary" for="btncheck1">Admin</label>
                                    </div>
                                </div>
                                @endif

                                <div class="mb-3">
                                    <div class="mb-2 @error('password') text-danger fw-bold @enderror">Password</div>
                                    <input type="password" name="password" value="{{ old('password') }}" placeholder="Password" 
                                    class="form-control @error('password') text-danger is-invalid @enderror">
                                    @error('password')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 @error('password') text-danger fw-bold @enderror">Confirm Password:</div>
                                    <input type="password" name="password_confirmation" value="{{ old('password') }}" placeholder="Password" 
                                    class="form-control @error('password') text-danger is-invalid @enderror">
                                    @error('password')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <button class="btn btn-dark">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection