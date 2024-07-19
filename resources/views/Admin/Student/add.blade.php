@extends('Admin.layout.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/nepali.date.picker.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                            <a href="{{ route('admin.admin-dashboard.branch.index') }}">
                                <span class="mb-1 " style="text-transform: capitalize">
                                    Student Info |
                                </span>
                            </a>
                            <span class="mb-1 " style="text-transform: capitalize">
                                Student Add
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
        <form method="POST" action="{{ route('admin.admin-dashboard.student.add') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-primary btn-sm ms-auto">Save</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-uppercase text-sm">Student Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Addmission Date</label>
                                        <input type="text" id="nepali-datepicker" class="form-control"
                                            name="admission_date" placeholder=" " />

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Student Photo</label>
                                        <input class="form-control" type="file" value="" name="student_photo">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">First Name</label>
                                        <input class="form-control" type="text" name="first_name">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Middle Name</label>
                                        <input class="form-control" type="text" name="middle_name">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Last Name
                                            Number</label>
                                        <input class="form-control" type="text" value="" name="last_name">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="selected" selected disabled>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">FeMale</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Date Of Birth</label>
                                        <input class="form-control" type="text" id="nepali-datepickers" value=""
                                            name="dob">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email</label>
                                        <input class="form-control" type="email" value="" name="email">
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            {{-- <p class="text-uppercase text-sm">Contact Information</p> --}}
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Phone Number</label>
                                        <input class="form-control" type="number" value="" name="phone">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Address</label>
                                        <input class="form-control" type="text" value="" name="address">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Father Name</label>
                                        <input class="form-control" type="text" value="" name="father_name">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Father Phone
                                            Number</label>
                                        <input class="form-control" type="number" value="" name="father_phone">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Course</label>
                                        <input class="form-control" type="text" value="" name="course">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Country</label>
                                        <select name="country_id" id="" class="form-control country ">
                                            @foreach ($countrys as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Document Information</p>
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Document 01
                                            Name</label>
                                        <input class="form-control" type="text" value="" name="doument_text_1">
                                        <br>
                                        <input class="form-control" type="file" placeholder="01"
                                            name="doument_image_1">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Document 02
                                            Name</label>
                                        <input class="form-control" type="text" value="" name="doument_text_2">
                                        <br>
                                        {{-- <label for="example-text-input" class="form-control-label">Document 01
                                            Name</label> --}}
                                        <input class="form-control" type="file" value="02"
                                            name="doument_image_2">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Document 03
                                            Name</label>
                                        <input class="form-control" type="text" value="" name="doument_text_3">
                                        <br>
                                        {{-- <label for="example-text-input" class="form-control-label">Document 01
                                            Name</label> --}}
                                        <input class="form-control" type="file" value="03"
                                            name="doument_image_3">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Document 04
                                            Name</label>
                                        <input class="form-control" type="text" value="" name="doument_text_4">
                                        <br>
                                        {{-- <label for="example-text-input" class="form-control-label">Document 01
                                            Name</label> --}}
                                        <input class="form-control" type="file" value="04"
                                            name="doument_image_4">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-3">
                    <div class="card ">
                        <div class="card-body">
                            <input type="file" name="image" id="image" class="photo">
                        </div>
                    </div>
                </div> --}}
            </div>
            {{-- <button class="btn btn-primary">save</button> --}}

        </form>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('assets/js/date.picker.nepali.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.photo').dropify();
        });
        window.onload = function() {
            var mainInput = document.getElementById("nepali-datepicker");
            var mainInputs = document.getElementById("nepali-datepickers");
            mainInput.nepaliDatePicker();
            mainInputs.nepaliDatePicker();
        };
        $(document).ready(function() {
            $('.country').select2();
        });
    </script>
@endsection
