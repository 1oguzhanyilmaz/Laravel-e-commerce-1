@extends('frontEnd.layouts.app-frontend')
@section('title','Cart')

@section('content')
    <div class="col-md-2">
        @include('frontEnd.layouts.left-side')
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

        <div class="card">
            <div class="card-header">Cart</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="small">
                            @foreach($cart_datas as $cart_data)
                                <?php
                                $image_products=DB::table('products')
                                    ->select('image')
                                    ->where('id',$cart_data->products_id)
                                    ->get();
                                ?>
                                <tr>
                                    <td>
                                        @foreach($image_products as $image_product)
                                            <a href="">
                                                <img src="{{url('products/small',$image_product->image)}}" alt="img" style="width: 100px;">
                                            </a>
                                        @endforeach
                                    </td>
                                    <td>
                                        <h5><a href="">{{$cart_data->product_name}}</a></h5>
                                        <p>{{$cart_data->product_code}} | {{$cart_data->size}}</p>
                                    </td>
                                    <td><p>{{$cart_data->price}} TL</p></td>
                                    <td>
                                        <a href="{{url('/cart/update-quantity/'.$cart_data->id.'/1')}}">
                                            <button class="font-weight-bold btn btn-sm btn-outline-success border-0">+</button>
                                        </a>
                                        <span class="m-2" id="quantity">{{$cart_data->quantity}}</span>
                                        @if($cart_data->quantity > 1)
                                            <a href="{{url('/cart/update-quantity/'.$cart_data->id.'/-1')}}">
                                                <button class="font-weight-bold btn btn-sm btn-outline-success border-0">-</button>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <p class="">{{$cart_data->price*$cart_data->quantity}} TL</p>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-outline-danger border-0" href="{{url('/cart/deleteItem',$cart_data->id)}}">
                                            X
                                        </a>
                                    </td>
                                </tr>
                                <hr class="p-1">
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr class="p-2">
                <div class="row">
                    <div class="col-sm-12">
                        <h5>What would you like to do next?</h5>
                        <p>Choose if you have a discount code or reward points
                            you want to use or would like to estimate your delivery cost.</p>
                    </div>
                </div>
                <hr class="p-2">
                <div class="row">
                    <div class="col-sm-6 p-4">
                        @if(Session::has('message_coupon'))
                            <div class="alert alert-danger text-center" role="alert">
                                {{Session::get('message_coupon')}}
                            </div>
                        @endif
                        <form action="{{url('/apply-coupon')}}" method="POST">
                            @csrf
                            <input type="hidden" name="Total_amountPrice" value="{{$total_price}}">
                            <div class="form-group">
                                {{--<label for="coupon_code">Coupon Code:</label>--}}
                                <input type="text" class="form-control form-control-sm" name="coupon_code" id="coupon_code"
                                       placeholder="Please enter coupon code">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Apply</button>
                        </form>
                    </div>
                    <div class="col-sm-6 p-4">
                        @if(Session::has('discount_amount_price'))
                            <input class="form-control-sm form-control" type="text" disabled="disabled" name="sub_total"
                                   value="Sub Total {{$total_price}} TL">
                            <input class="form-control-sm form-control" type="text" disabled="disabled" name="coupon_dis"
                                   value="Coupon Discount (Code : {{Session::get('coupon_code')}}) - {{Session::get('discount_amount_price')}} TL">
                            <input class="form-control-sm form-control" type="text" disabled="disabled" name="sub_total"
                                   value="Total {{$total_price-Session::get('discount_amount_price')}} TL">
                        @else
                            <input class="form-control-sm form-control" type="text" disabled="disabled" value="Total {{$total_price}} TL">
                        @endif
                        <div class="mt-4 float-right">
                            <a class="btn btn-primary btn-sm" href="{{url('/check-out')}}">Check Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        @include('frontEnd.layouts.right-side')
    </div>
@endsection

@section('jsblock')
@endsection