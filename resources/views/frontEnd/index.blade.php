@extends('frontEnd.layouts.app-frontend')
@section('title','Home')

@section('content')
    <div class="col-md-2">
        @include('frontEnd.layouts.left-side')
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Homee</div>
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