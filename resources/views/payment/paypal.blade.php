@extends('frontEnd.layouts.app-frontend')
@section('title','Paypal')

@section('content')
    {{Session::forget('session_id')}}
    <div class="col-md-2">
        {{--@include('frontEnd.layouts.left-side')--}}
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Paypal</div>
            <div class="card-body text-center p-4 m-4">
                <h1 class="text-success">Succesfully</h1>
                <hr class="p-4">
                <h3 class="">YOUR ORDER HAS BEEN PLACED</h3>
                <hr class="p-4">
                <p class="">Thanks for your Order that use Options on Cash On Delivery</p>
                <p class="">
                    We will contact you by Your Email
                    (<b>{{$user_order->users_email}}</b>)
                    or Your Phone Number (<b>{{$user_order->mobile}}</b>)
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        {{--@include('frontEnd.layouts.right-side')--}}
    </div>
@endsection

@section('jsblock')
@endsection