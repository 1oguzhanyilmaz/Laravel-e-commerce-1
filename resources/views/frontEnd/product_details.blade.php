@extends('frontEnd.layouts.app-frontend')
@section('title','Product Details')

@section('cssblock')
@endsection

@section('content')
    <div class="col-md-2">
        @include('frontEnd.layouts.left-side')
    </div>
    <div class="col-md-8">
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
            <div class="card-header">Product Details</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                            <a href="{{url('products/large',$detail_product->image)}}">
                                <img src="{{url('products/small',$detail_product->image)}}" alt="" />
                            </a>
                        </div>
                        <ul class="thumbnails" style="list-style: none;">
                            <li>
                            @foreach($imagesGalleries as $imagesGallery)
                                <a href="{{url('products/large',$imagesGallery->image)}}"
                                   data-standard="{{url('products/small',$imagesGallery->image)}}">
                                    <img src="{{url('products/small',$imagesGallery->image)}}" alt="" width="75" />
                                </a>
                            @endforeach
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-8">
                        <form action="{{route('addToCart')}}" method="POST">
                            @csrf
                            <input type="hidden" name="products_id" value="{{$detail_product->id}}">
                            <input type="hidden" name="product_name" value="{{$detail_product->p_name}}">
                            <input type="hidden" name="product_code" value="{{$detail_product->p_code}}">
                            <input type="hidden" name="product_color" value="{{$detail_product->p_color}}">
                            <input type="hidden" name="price" value="{{$detail_product->price}}"
                                   id="dynamicPriceInput">
                            <div class="product-information">
                                <h4>{{$detail_product->p_name}}</h4>
                                <hr class="p-1">
                                <h6>Code ID: {{$detail_product->p_code}}</h6>
                                <hr class="p-1">
                                <p>
                                    <b>Availability:</b>
                                    @if($totalStock>0)
                                        <span id="availableStock">In Stock</span>
                                    @else
                                        <span id="availableStock" class="text-danger font-weight-bold">Out of Stock</span>
                                    @endif
                                </p>
                                <hr class="p-1">
                                <p id="dynamic_price"><b>Price : </b> {{$detail_product->price}} TL</p>
                                <hr class="p-1">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="size">Choose Size:</label>
                                        <select name="size" id="idSize" class="form-control form-control-sm">
                                            <option value="">Select Size</option>
                                            @foreach($detail_product->attributes as $attrs)
                                                <option value="{{$detail_product->id}}-{{$attrs->size}}">{{$attrs->size}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="quantity">Quantity:</label>
                                        <input type="number" class="form-control form-control-sm" name="quantity" value="{{$totalStock}}" id="inputStock"/>
                                    </div>
                                </div>
                                <br>
                                @if($totalStock>0)
                                    <button type="submit" class="btn btn-success border-0 cart" id="buttonAddToCart">
                                        <i class="fa fa-plus"> Add to Cart</i>
                                    </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
                <hr class="p-2">
                <div class="row">
                    <div class="col-sm-12">
                        <p>Description : </p>
                        <p>{!! $detail_product->description !!}</p>
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
    <script src="{{asset('easyzoom/dist/easyzoom.js')}}"></script>
    <script>
        console.log( "Easyzoom - ready!" );
        // Instantiate EasyZoom instances
        var $easyzoom = $('.easyzoom').easyZoom();

        // Setup thumbnails example
        var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');
        $('.thumbnails').on('click', 'a', function(e) {
            var $this = $(this);
            e.preventDefault();
            // Use EasyZoom's `swap` method
            api1.swap($this.data('standard'), $this.attr('href'));
        });
    </script>
@endsection