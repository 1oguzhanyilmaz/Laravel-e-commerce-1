@extends('frontEnd.layouts.app-frontend')
@section('title','Account')

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
            {{-- Profile --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Account</div>
                    <div class="card-body">
                        <form action="{{url('/update-profile',$user_login->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{$user_login->name}}">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{$user_login->address}}">
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" name="city" id="city" value="{{$user_login->city}}">
                            </div>
                            <div class="form-group">
                                <select name="country" id="country" class="form-control">
                                    @foreach($countries as $country)
                                        <option value="{{$country->country_name}}"
                                                {{$user_login->country == $country->country_name?' selected':''}}>
                                            {{$country->country_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile:</label>
                                <input type="text" class="form-control" id="mobile" name="mobile"
                                       value="{{$user_login->mobile}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Account</button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Password --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Password</div>
                    <div class="card-body">
                        <form action="{{url('/update-password',$user_login->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password"
                                       value="{{old('password')}}">
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New Password:</label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword"
                                       value="{{old('newPassword')}}">
                            </div>
                            <div class="form-group">
                                <label for="newPassword_confirmation">Confirm Password:</label>
                                <input type="password" class="form-control"
                                       id="newPassword_confirmation" name="newPassword_confirmation"
                                       value="{{old('newPassword_confirmation')}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Password</button>
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