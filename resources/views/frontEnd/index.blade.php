@extends('frontEnd.layouts.app-frontend')
@section('title','Home')

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
            <div class="card-header">Products</div>
            <div class="card-body">
                <div class="row">
                    @foreach($products as $product)
                        @if($product->category->status==1)
                            <div class="col-sm-2">
                                <div class="card mb-4 box-shadow border-0">
                                    <img class="card-img-top"
                                         data-src=""
                                         alt="product image"
                                         style="height: 100px; width: 100%; display: block;"
                                         src="{{url('products/small/',$product->image)}}"
                                         data-holder-rendered="true">
                                    <div class="card-body">
                                        <p class="card-text">
                                        <h5>TL {{$product->price}}</h5>
                                        <p>{{$product->p_name}}</p>
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="{{url('/product-detail',$product->id)}}" class="btn btn-default">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
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