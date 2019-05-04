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

        <form action="{{url('/submit-checkout')}}" method="POST">
            @csrf
            <div class="row">
                {{-- Billing --}}
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Billing</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="billing_name">Billing Name</label>
                                <input type="text" class="form-control" name="billing_name" id="billing_name"
                                       value="{{$user_login->name}}">
                            </div>
                            <div class="form-group">
                                <label for="billing_address">Billing Address</label>
                                <input type="text" class="form-control" name="billing_address" id="billing_address"
                                       value="{{$user_login->address}}">
                            </div>
                            <div class="form-group">
                                <label for="billing_city">Billing City</label>
                                <input type="text" class="form-control" name="billing_city" id="billing_city"
                                       value="{{$user_login->city}}">
                            </div>
                            <div class="form-group">
                                <label for="billing_country">Billing Country</label>
                                <select name="billing_country" id="billing_country" class="form-control">
                                    @foreach($countries as $country)
                                        <option value="{{$country->country_name}}"
                                                {{$user_login->country == $country->country_name?' selected':''}}>
                                            {{$country->country_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="billing_mobile">Billing Mobile:</label>
                                <input type="text" class="form-control" id="billing_mobile" name="billing_mobile"
                                       value="{{$user_login->mobile}}">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Shipping --}}
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Shipping</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="billing_name">Shipping Name</label>
                                <input type="text" class="form-control" name="shipping_name" id="shipping_name"
                                       value="">
                            </div>
                            <div class="form-group">
                                <label for="billing_address">Shipping Address</label>
                                <input type="text" class="form-control" name="shipping_address" id="shipping_address"
                                       value="">
                            </div>
                            <div class="form-group">
                                <label for="billing_city">Shipping City</label>
                                <input type="text" class="form-control" name="shipping_city" id="shipping_city"
                                       value="">
                            </div>
                            <div class="form-group">
                                <label for="billing_country">Shipping Country</label>
                                <select name="shipping_country" id="shipping_country" class="form-control">
                                    @foreach($countries as $country)
                                        <option value="{{$country->country_name}}"
                                                {{$user_login->country == $country->country_name?' selected':''}}>
                                            {{$country->country_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="billing_mobile">Shipping Mobile:</label>
                                <input type="text" class="form-control" id="shipping_mobile" name="shipping_mobile"
                                       value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" value="" name="checkme" id="checkme">
                            Shipping Address same as Billing Address
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary float-right">Checkout</button>
                </div>
            </div>
        </form>

    </div>
    <div class="col-md-2">
        {{--@include('frontEnd.layouts.right-side')--}}
        {{--<input type="checkbox" id="checkbox1"/><br />--}}
        {{--<input type="text" id="textbox1"  value="abc"/> <br>--}}
        {{--<input type="text" id="textbox2"/>--}}
    </div>
@endsection

@section('jsblock')
    <script>
        $(document).ready(function() {
            // $('#checkbox1').change(function() {
            //     if(this.checked) {
            //         var tut = $('#textbox1').val();
            //         $('#textbox2').val(tut);
            //     }else {
            //         $('#textbox2').val('');
            //     }
            // });
            $('#checkme').change(function() {
                if(this.checked) {
                    $('#shipping_name').val($('#billing_name').val());
                    $('#shipping_address').val($('#billing_address').val());
                    $('#shipping_city').val($('#billing_city').val());
                    $('#shipping_mobile').val($('#billing_mobile').val());
                    $('#shipping_country').val($('#billing_country').val());
                }else {
                    $('#shipping_name').val('');
                    $('#shipping_address').val('');
                    $('#shipping_city').val('');
                    $('#shipping_mobile').val('');
                    $('#shipping_country').val('');
                }
            });
        });
    </script>
@endsection