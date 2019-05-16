@extends('frontEnd.layouts.app-frontend')
@section('title','Order Review')

@section('content')
    <div class="col-md-2">
        {{--@include('frontEnd.layouts.left-side')--}}
    </div>

    <div class="col-md-8">
        <form action="{{url('/submit-order')}}" method="POST">
            @csrf
            <input type="hidden" name="users_id" value="{{$shipping_address->users_id}}">
            <input type="hidden" name="users_email" value="{{$shipping_address->users_email}}">
            <input type="hidden" name="name" value="{{$shipping_address->name}}">
            <input type="hidden" name="address" value="{{$shipping_address->address}}">
            <input type="hidden" name="city" value="{{$shipping_address->city}}">
            <input type="hidden" name="country" value="{{$shipping_address->country}}">
            <input type="hidden" name="mobile" value="{{$shipping_address->mobile}}">
            <input type="hidden" name="shipping_charges" value="0">
            <input type="hidden" name="order_status" value="success">
            @if(Session::has('discount_amount_price'))
                <input type="hidden" name="coupon_code" value="{{Session::get('coupon_code')}}">
                <input type="hidden" name="coupon_amount" value="{{Session::get('discount_amount_price')}}">
                <input type="hidden" name="grand_total" value="{{$total_price-Session::get('discount_amount_price')}}">
            @else
                <input type="hidden" name="coupon_code" value="No Coupon">
                <input type="hidden" name="coupon_amount" value="0">
                <input type="hidden" name="grand_total" value="{{$total_price}}">
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">Shipping</div>
                        <div class="card-body">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Country</th>
                                        <th>Mobile</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$shipping_address->name}}</td>
                                        <td>{{$shipping_address->address}}</td>
                                        <td>{{$shipping_address->city}}</td>
                                        <td>{{$shipping_address->country}}</td>
                                        <td>{{$shipping_address->mobile}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="p-2">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">Review & Payment</div>
                        <div class="card-body">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Item</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($cart_datas as $cart_data)
                                    <?php
                                    $image_products = DB::table('products')
                                        ->select('image')
                                        ->where('id',$cart_data->products_id)
                                        ->get();
                                    ?>
                                    <tr>
                                        <td>
                                            @foreach($image_products as $image_product)
                                                <img src="{{url('products/small',$image_product->image)}}" alt="img" style="width: 100px;">
                                            @endforeach
                                        </td>
                                        <td>
                                            <h5>{{$cart_data->product_name}}</h5>
                                            <p>{{$cart_data->product_code}} | {{$cart_data->size}} | {{$cart_data->product_color}}</p>
                                        </td>
                                        <td><p>{{$cart_data->price}} TL</p></td>
                                        <td><p>x {{$cart_data->quantity}}</p></td>
                                        <td><p>{{$cart_data->price*$cart_data->quantity}} TL</p></td>
                                    </tr>
                                @endforeach
                                <hr class="p-1">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p>Cart Sub Total : <b>{{$total_price}} TL</b></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                @if(Session::has('discount_amount_price'))
                                                    <p>Coupon Discount : <b>{{Session::get('discount_amount_price')}} TL</b></p>
                                                    <p>Total : <b>{{$total_price-(Session::get('discount_amount_price'))}} TL</b></p>
                                                @else
                                                    <p>Total : <b>{{$total_price}} TL</b></p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="p-2">
            <div class="row">
                <div class="col-sm-12">
                    <span class="float-right">
                        <h6>Select Payment Method :</h6>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="payment_method" value="COD" checked>
                                Cash On Delivery
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="payment_method" value="paypal">
                                Paypal
                            </label>
                        </div>
                    </span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-right mt-4">Order</button>
        </form>
    </div>
    <div class="col-md-2">
        {{--@include('frontEnd.layouts.right-side')--}}
    </div>
@endsection

@section('jsblock')
@endsection