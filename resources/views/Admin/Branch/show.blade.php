@extends('Admin.layout.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        input{
            outline: none;
        }
    </style>
@endsection
@section('content')
    <div class="card shadow-lg card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="  my-auto ">
                    <div class="h-100  " style="display: flex; justify-content: space-between">
                        <span class="mb-1 " style="text-transform: capitalize">
                            Branch Information
                        </span>
                        <span>
                            <a href="{{ route('admin.admin-dashboard.index') }}">
                                <span class="mb-1 " style="text-transform: capitalize">
                                    Dashboard |
                                </span>
                            </a>
                            <a href="{{ route('admin.admin-dashboard.branch.index') }}">
                                <span class="mb-1 " style="text-transform: capitalize">
                                    Branch Info |
                                </span>
                            </a>
                            <span class="mb-1 " style="text-transform: capitalize">
                                Branch Show
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container-fluid py-4">
        <form method="POST" action="{{ route('admin.admin-dashboard.branch.edit', ['slug' => $branch->slug]) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                               <a href="{{route('admin.admin-dashboard.branch.index')}}"> <button class="btn btn-danger btn-sm ms-auto">Cancle</button></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-uppercase text-sm">Branch Information</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Branch Name</label>
                                        <input class="form-control" type="text" name="name"
                                            value="{{ $branch->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Branch address</label>
                                        <input class="form-control" type="text" name="address"
                                            value="{{ $branch->address }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Branch Phone
                                            Number</label>
                                        <input class="form-control" type="number" name="phone"
                                            value="{{ $branch->phone }}">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Branch Email</label>
                                        <input class="form-control" type="email" name="email"
                                            value="{{ $branch->email }}">
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card ">
                        <div class="card-body">
                           <img src="{{ asset($branch->image) }}" alt="" width="328px">
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.photo').dropify();
        });
    </script>
@endsection
