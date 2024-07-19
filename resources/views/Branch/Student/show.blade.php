@extends('Admin.layout.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        input {
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
                            Student Information
                        </span>
                        <span>
                            <a href="{{ route('admin.admin-dashboard.index') }}">
                                <span class="mb-1 " style="text-transform: capitalize">
                                    Dashboard |
                                </span>
                            </a>
                            <a href="{{ route('admin.admin-dashboard.student.index') }}">
                                <span class="mb-1 " style="text-transform: capitalize">
                                    Student Info |
                                </span>
                            </a>
                            <span class="mb-1 " style="text-transform: capitalize">
                                Student Show
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
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Edit Profile</p>
                            <a class="btn btn-primary btn-sm ms-auto"
                                href="{{ route('admin.admin-dashboard.student.edit', ['slug' => $student->slug]) }}">Edit
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-uppercase text-sm">Student Information</p>
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <label for="example-text-input" class="form-control-label">Admission Date</label>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <span class="form-control-label">{{ $student->admission_date }}</span>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <label for="example-text-input" class="form-control-label">Date Of Birth</label>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <span class="form-control-label">{{ $student->dob }}</span>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <label for="example-text-input" class="form-control-label"> Phone Number</label>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <span class="form-control-label">{{ $student->phone }}</span>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <label for="example-text-input" class="form-control-label">Email Address</label>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <span class="form-control-label">{{ $student->email }}</span>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <label for="example-text-input" class="form-control-label">Permanent Address</label>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <span class="form-control-label">{{ $student->address }}</span>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <label for="example-text-input" class="form-control-label">Course</label>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <span class="form-control-label">{{ $student->course }}</span>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <label for="example-text-input" class="form-control-label">Country</label>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <span class="form-control-label">{{ $student->country->name }}</span>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <label for="example-text-input" class="form-control-label">Father Name </label>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <span class="form-control-label">{{ $student->father_name }}</span>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <label for="example-text-input" class="form-control-label">Father Phone </label>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <span class="form-control-label">{{ $student->father_phone }}</span>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <p class="text-uppercase text-sm">Document Information</p>
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <label for="example-text-input"
                                    class="form-control-label">{{ $student->doument_text_1 }}</label>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <a href="{{ asset($student->doument_image_1) }}" class="btn btn-primary btn-sm"
                                    target="_blank">View Document</a>
                                <a href="{{ asset($student->doument_image_1) }}" download
                                    class="btn btn-success btn-sm">Download Document</a>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <label for="example-text-input"
                                    class="form-control-label">{{ $student->doument_text_2 }}</label>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <a href="{{ asset($student->doument_image_2) }}" class="btn btn-primary btn-sm"
                                    target="_blank">View Document</a>
                                <a href="{{ asset($student->doument_image_2) }}" download
                                    class="btn btn-success btn-sm">Download Document</a>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <label for="example-text-input"
                                    class="form-control-label">{{ $student->doument_text_3 }}</label>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <a href="{{ asset($student->doument_image_3) }}" class="btn btn-primary btn-sm"
                                    target="_blank">View Document</a>
                                <a href="{{ asset($student->doument_image_3) }}" download
                                    class="btn btn-success btn-sm">Download Document</a>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <label for="example-text-input"
                                    class="form-control-label">{{ $student->doument_text_4 }}</label>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <a href="{{ asset($student->doument_image_4) }}" class="btn btn-primary btn-sm"
                                    target="_blank">View Document</a>
                                <a href="{{ asset($student->doument_image_4) }}" download
                                    class="btn btn-success btn-sm">Download Document</a>
                            </div>
                        </div>
                        <hr class="horizontal dark">


                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-profile">
                    <img src="{{ asset($student->student_photo) }}" alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-4 col-lg-4 order-lg-2">
                            <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                <a href="javascript:;">
                                    <img src="{{ asset($student->student_photo) }}"
                                        class="rounded-circle img-fluid border border-2 border-white">
                                </a>
                            </div>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="rosw">
                            <div class="colsss p-1" style="">
                                <div class="d-flex justify-content-between ">
                                    <div>
                                        <div class="name">Student Name</div>
                                    </div>
                                    <div class="">
                                        <div class="name" style="text-align: right">
                                            {{ $student->first_name . ' ' . $student->middle_name . '  ' . $student->last_name }}
                                        </div>
                                    </div>
                                </div>
                                <hr class="horizontal dark">

                                <div class="d-flex justify-content-between ">
                                    <div>
                                        <div class="name">Admission Date</div>
                                    </div>
                                    <div class="" style="text-align: right">
                                        <div class="name">{{ $student->admission_date }}</div>
                                    </div>
                                </div>
                                <hr class="horizontal dark">

                                <div class="d-flex justify-content-between ">
                                    <div>
                                        <div class="name">Gender</div>
                                    </div>

                                    <div class="">
                                        <div class="name" style="text-align: right">{{ $student->gender }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

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
