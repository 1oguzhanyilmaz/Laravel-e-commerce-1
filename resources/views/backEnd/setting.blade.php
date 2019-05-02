@extends('backEnd.layouts.app-backend')
@section('title','Settings')

@section('content')
    <div class="col-md-9">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active"><a href="/admin/settings">Settings</a></li>
        </ol>
        <div class="card">
            <div class="card-header">Update Settings</div>
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

                <form action="{{url('/admin/update-pwd')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="pwd_current">Current Password:</label>
                        <input type="password" class="form-control" name="pwd_current" id="pwd_current">
                    </div>
                    <div class="form-group">
                        <label for="pwd_new">New Password:</label>
                        <input type="password" class="form-control" name="pwd_new" id="pwd_new">
                    </div>
                    <div class="form-group">
                        <label for="pwdnew_confirm">Confirm Password:</label>
                        <input type="password" class="form-control" name="pwdnew_confirm" id="pwdnew_confirm">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('jsblock')
@endsection