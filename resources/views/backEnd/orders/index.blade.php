@extends('backEnd.layouts.app-backend')
@section('title','Orders')

@section('content')
    <div class="col-md-9">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Orders</a></li>
        </ol>
        <div class="card">
            <div class="card-header">
                Orders
            </div>
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

                <table class="table small">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Method</th>
                        <th>Paid</th>
                        <th>Shipping</th>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="">
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->name}}</td>
                            <td>{{$order->users_email}}</td>
                            <td>{{$order->created_at->format('d/m/Y')}}</td>
                            <td>{{$order->grand_total}} TL</td>
                            <td>{{$order->payment_method}}</td>
                            <td>{{$order->paid}}</td>
                            <td>{{$order->shipping}}</td>
                            <td>
                                <?php
                                $order_products = DB::table('order_products')->where('order_id',$order->id)->get();
                                ?>
                                <a href="#myModal{{$order->id}}" data-toggle="modal" data-target="#myModal{{$order->id}}"
                                   class="btn btn-sm btn-outline-primary border-0">Details</a>
                            </td>
                            <td>
                                @if($order->shipping == 0)
                                    <form action="{{ url('/admin/order/'.$order->id) }}" method="POST">
                                        @csrf
                                        <button onclick="return confirm('Are you sure?')" type="submit"
                                                class="btn btn-sm btn-primary">Complete</button>
                                    </form>
                                @else
                                    <p><b class="text-primary">Completed</b></p>
                                @endif
                            </td>
                        </tr>

                        <!-- The Modal -->
                        <div class="modal fade" id="myModal{{$order->id}}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{$order->name}} - Order Details</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5>Shipping Address</h5>
                                                <hr class="p-1">
                                                <b>Address : </b> {{$order->address}} <br>
                                                <b>City : </b> {{$order->city}} <br>
                                                <b>Mobile : </b> {{$order->mobile}} <br>
                                            </div>
                                            <div class="col-md-8">
                                                <h5>Products</h5>
                                                @foreach($order_products as $o_p)
                                                    <?php
                                                    $product = DB::table('products')->where('id',$o_p->product_id)->first();
                                                    ?><hr class="p-1">
                                                        <b>Product: </b>{{$product->p_name}}<br>
                                                        <b>Quantity: </b>{{$o_p->quantity}}<br>
                                                        <b>Size: </b>{{$o_p->size}}

                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    @endforeach
                    </tbody>
                </table>
                    {!! $orders->links() !!}
            </div>
        </div>
    </div>
@endsection

@section('jsblock')
@endsection