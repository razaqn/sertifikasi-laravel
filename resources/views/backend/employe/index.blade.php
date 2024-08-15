@extends('layouts.app')

@section('title')
    Employe | Manage
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">  
@endsection

@section('javascript')
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('table').DataTable({
                "pageLength" : 50
            })
        })
    </script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Employe') }}
                    <a href="{{ route('backend.create.employe') }}" class="btn btn-sm btn-success">
                        Create
                    </a>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {!! session('error') !!}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {!! session('success') !!}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <table id="dataTable" class="table table-bordered table-hover table-striped mb-0">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col" width="300">Image</th>
                            <th scope="col">Department</th>
                            <th scope="col">Fullname</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($employes as $item)
                          <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td><img src="{{ asset('image/employes/'. $item->image) }}" alt="" class="img-thumbnail"></td>
                            <td>{{ $item->department->name }}</td>
                            <td>{{ $item->fullname }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>
                                <a href="{{ route('backend.edit.employe', $item->id) }}" class="btn btn-sm btn-success">
                                    <i class="fa-solid fa-pencil"></i> Edit
                                </a>

                                <a href="{{ route('backend.show.employe', $item->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-search"></i> Show
                                </a>

                                <form action="{{ route('backend.destroy.process.employe', $item->id) }}" method="post" class="d-inline" >
                                    @csrf
                                    <input type="hidden" value="{{$item->id}}" name="id">
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt pe-1"></i> Destroy
                                    </button>
                                </form>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection