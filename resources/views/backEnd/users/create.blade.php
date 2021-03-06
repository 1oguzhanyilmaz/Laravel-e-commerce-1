@extends('backEnd.layouts.app-backend')
@section('title','Create User')

@section('content')
    <div class="col-md-9">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/users">Users</a></li>
            <li class="breadcrumb-item active"><a href="#">Add New User</a></li>
        </ol>
        <div class="card">
            <div class="card-header">Add New User</div>
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    <hr>
                @endif
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    <hr>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <hr>
                @endif
                    <form action="{{url('/admin/users')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name :</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address :</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
                        </div>
                        <div class="form-group">
                            <label for="c_password">Confirm Password:</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{old('password_confirmation')}}">
                        </div>
                        <div class="form-group">
                            <label for="admin"><strong>Select Role</strong></label>
                            <select class="form-control" name="admin" id="admin">
                                <option value="0">Normal User</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Signup</button>
                    </form>
            </div>
        </div>
    </div>
@endsection

@section('jsblock')
@endsection