@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('User Management') }}</div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="col-md-2">
                            <a href="{{route('export.user')}}" class="btn btn-primary">Export as CSV</a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{route('create.user')}}" class="btn btn-primary">New User</a>
                        </div>

                        <div class="col-md-2">
                            <form method="POST" enctype="multipart/form-data" action="{{ route('import.user') }}">
                            @csrf
                            <div class="col-md-8 pb-2">
                                <input type="file" class="@error('csv_file') is-invalid @enderror" name="csv_file" id="csv_file">
                                </div>
                                <div class="col-md-8">
                                <button class="btn btn-primary">Import CSV</a>
</div>
                            </form>

                        </div>

                    </div>
                    <div class="form-group">
                        <label for="gender" class="col-md-2 col-form-label text-md-right">{{ __('Gender') }}</label>

                        <div class="col-md-2">
                            <select class="form-control" id="gender" name="gender">
                                <option value="">All</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>


                    <table id="users-table" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Age</th>
                                <th>Gender</th>
                            </tr>
                        </thead>
                    </table>



                </div>
            </div>
        </div>
    </div>
</div>

@endsection