@extends('backEnd.layouts.app-backend')
@section('title','Edit Coupon')

@section('content')
    <div class="col-md-9">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/coupon">Coupons</a></li>
            <li class="breadcrumb-item active"><a href="#">Edit Coupon</a></li>
        </ol>
        <div class="card">
            <div class="card-header">Edit Coupon</div>
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
                <form action="{{route('coupon.update',$edit_coupons->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="coupon_code">Coupon Code:</label>
                        <input type="text" class="form-control form-control-sm"
                               name="coupon_code" id="coupon_code" value="{{$edit_coupons->coupon_code}}">
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="number" class="form-control form-control-sm"
                               name="amount" id="amount" placeholder="%" value="{{$edit_coupons->amount}}">
                    </div>
                    <div class="form-group">
                        <label for="amount_type"><strong>Amount Type</strong></label>
                        <select class="form-control form-control-sm" name="amount_type" id="amount_type">
                            <option value="Percentage">Percentage</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="expiry_date">Expiry Date</label>
                        <input type="date" name="expiry_date" id="expiry_date" max="3000-12-31" min="1000-01-01"
                               value="{{$edit_coupons->expiry_date}}" class="form-control form-control-sm">
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="status" id="status" value="1"
                                    {{$edit_coupons->status==1?'checked':''}}>Enable
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Update Coupon</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('jsblock')

@endsection