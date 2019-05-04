@extends('frontEnd.layouts.app-frontend')
@section('title','Login - Register')

@section('content')
    <div class="col-md-2">
        {{--@include('frontEnd.layouts.left-side')--}}
    </div>
    <div class="col-md-8">
        {{--Messages--}}
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

        <div class="row">
            {{--Login--}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login to your account</div>
                    <div class="card-body">
                        <form action="{{url('/user-login')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email address:</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="form-group form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox"> Remember me
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
            {{--New User--}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">New User Signup!</div>
                    <div class="card-body">
                        <form action="{{url('/user-register')}}" method="POST">
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
                            <button type="submit" class="btn btn-primary">Signup</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-2">
        {{--@include('frontEnd.layouts.right-side')--}}
    </div>
@endsection

@section('jsblock')
@endsection