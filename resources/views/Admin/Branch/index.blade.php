@extends('Admin.layout.app')
@section('css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
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
                            <a href="{{ route('admin.admin-dashboard.branch.add') }}">
                                <button class="btn btn-primary btn-sm ms-auto">Add Branch</button>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-7">
        <div class="card">
            <div class="card-body ">
                <table id="myTable" class="table table-striped ">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Branch Name </th>
                            <th>Branch Address</th>
                            <th>Branch Email</th>
                            <th>Branch Phone Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($branches as $branch)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <a href="#">
                                        <img src="{{ asset($branch->image) }}" class="rounded-circle" alt="Branch "
                                            width="45px">
                                        {{ $branch->name }}

                                    </a>
                                </td>
                                <td>{{ $branch->address }}</td>
                                <td>{{ $branch->email }}</td>
                                <td>{{ $branch->phone }}</td>
                                <td>
                                    <a href="{{ route('admin.admin-dashboard.branch.show', ['slug' => $branch->slug]) }}"
                                        class="btn btn-primary btn-sm ms-auto">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.admin-dashboard.branch.edit', ['slug' => $branch->slug]) }}"
                                        class="btn btn-primary btn-sm ms-auto">
                                        <i class="fa fa-pen"></i>

                                    </a>
                                    <a href="{{ route('admin.admin-dashboard.branch.del', ['slug' => $branch->slug]) }}"
                                        class="btn btn-danger btn-sm ms-auto">
                                        <i class="fa fa-trash"></i>

                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
