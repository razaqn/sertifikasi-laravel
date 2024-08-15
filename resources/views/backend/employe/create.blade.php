@extends('layouts.app')

@section('title')
    Employe | Create
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function () {
        $("input[name=image]").change(function() {
            imagePreview(this);
        });

        $('textarea[name=cv]').summernote({height: 100});
        $('textarea[name=address]').summernote({height: 100});

        $('select').select2();

        $('input[name="fullname"]').on('keyup', function(){
            let Text = $(this).val();
        
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        
            $('input[name="slug"]').val(Text);
        })
    });

    
        
    function imagePreview(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e){
                $("#preview").removeClass("d-none");
                $("#preview").attr("src",e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Employe | Create') }}</div>
                <div class="card-body">
                    <form id="contactForm" action="{{ route('backend.create.process.employe') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                
                                <div class="mb-3">
                                    <label class="mb-2 @error('image') text-danger fw-bold @enderror">Image:</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    <img src="" class="img-thumbnail mt-3 mb-3 d-none w-50" id="preview">
                                    @error('image')
                                        <div class="text-danger small" >{!! $message !!}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 @error('department_id') text-danger fw-bold @enderror">Department:</div>
                                    <select class="select2 form-control" name="department_id" class="">
                                        <option value="">Pilih Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 @error('fullname') text-danger fw-bold @enderror">Fullname:</div>
                                    <input type="text" name="fullname" value="{{ old('fullname') }}" placeholder="fullname" 
                                    class="form-control @error('fullname') text-danger is-invalid @enderror">
                                    @error('fullname')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 @error('slug') text-danger fw-bold @enderror">Slug:</div>
                                    <input type="text" name="slug" value="{{ old('slug') }}" placeholder="slug" 
                                    class="form-control @error('slug') text-danger is-invalid @enderror">
                                    @error('slug')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 @error('hp') text-danger fw-bold @enderror">Hp:</div>
                                    <input type="number" name="hp" value="{{ old('hp') }}" placeholder="hp" 
                                    class="form-control @error('hp') text-danger is-invalid @enderror">
                                    @error('hp')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 @error('cv') text-danger fw-bold @enderror">CV:</div>
                                    <textarea 
                                        class="form-control @error('cv') text-danger is-invalid @enderror"
                                        name="cv" placeholder="cv">
                                    </textarea>
                                    @error('cv')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 @error('address') text-danger fw-bold @enderror">Address:</div>
                                    <textarea 
                                        class="form-control @error('address') text-danger is-invalid @enderror"
                                        name="address" placeholder="address">
                                    </textarea>
                                    @error('address')
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