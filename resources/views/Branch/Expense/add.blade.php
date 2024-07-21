@extends('Branch.layout.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

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
                            Expense Information
                        </span>
                        <span>
                            <a href="{{ route('admin.branch-dashboard.expense.expense') }}">
                                <span class="mb-1 " style="text-transform: capitalize">
                                    Dashboard |
                                </span>
                            </a>
                            <a href="{{ route('admin.branch-dashboard.expense.expense') }}">
                                <span class="mb-1 " style="text-transform: capitalize">
                                    Expense Info |
                                </span>
                            </a>
                            <span class="mb-1 " style="text-transform: capitalize">
                                Expense Add
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

                    </div>
                    <div class="card-body">
                        <p class="text-uppercase text-sm">Expense Information</p>
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;

                                @endphp
                                {{-- @foreach ($expenses as $expense)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            <a href="{{ asset($expense->image) }}" download>
                                                <img src="{{ asset($expense->image) }}" class="rounded-circle"
                                                    alt="Student" width="45px">
                                            </a>
                                            {{ $expense->name }}
                                        </td>
                                        <td>{{ $expense->date }}</td>
                                        <td>{{ $expense->amount }}</td>
                                        <td>{{ $expense->payment_method }}</td>
                                        <td>{{ $expense->description }}</td>
                                        <td>
                                            
                                            dd
                                        </td>
                                    </tr>
                                @endforeach --}}
                                <div class="container">
                                    <canvas id="monthlyExpenseChart" width="400" height="200"></canvas>
                                </div>
                                
                                {!! $chart->container() !!}
                                {!! $chart->script() !!}
                            </tbody>
                        </table>
                    </div>
                    <hr class="horizontal dark">

                </div>
            </div>
            <div class="col-md-3">
                <div class="card ">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.branch-dashboard.expense.expense') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @php
                                $user = Auth::user();
                            @endphp
                            <input type="number" hidden name="branch_id" value="{{ $user->id }}">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label"> Name</label>
                                        <input class="form-control" type="text" name="name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Payment Method</label>
                                        <select name="payment_method" id="payment_method" class="form-control  country">
                                            <option value="Cash">Cash</option>
                                            <option value="Bank">Bank</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="Esewa">Esewa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Date
                                        </label>
                                        <input class="form-control" type="text" id="nepali-datepicker" name="date">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Amount</label>
                                        <input class="form-control" type="number" name="amount">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Image</label>
                                        <input class="form-control" type="file" name="image">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Description</label>
                                        <input class="form-control" type="text" name="description">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm ms-auto">Save</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('assets/js/date.picker.nepali.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.photo').dropify();
        });
        window.onload = function() {
            var mainInput = document.getElementById("nepali-datepicker");
            mainInput.nepaliDatePicker();
        };
        $(document).ready(function() {
            $('.country').select2();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
