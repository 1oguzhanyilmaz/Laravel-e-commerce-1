@extends('backEnd.layouts.app-backend')
@section('title','Products')

@section('content')
    <div class="col-md-10">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active"><a href="/admin/product">Products</a></li>
        </ol>
        <div class="card">
            <div class="card-header">
                Products
                <span class="float-right">
                    <a href="{{url('/admin/product/create')}}" class="btn btn-sm btn-success">Add New Product</a><br>
                </span>
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
                        <th>ID</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Under Category</th>
                        {{--<th>Code Of Product</th>--}}
                        {{--<th>Product Color</th>--}}
                        {{--<th>Price</th>--}}
                        <th>Image Gallery</th>
                        <th>Add Attribute</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="">
                    @foreach($products as $product)
                        <?php $i++; ?>
                        <?php $notice = ''; ?>
                        @foreach($product->attributes as $attrs)
                            @if($attrs->stock <= 0)
                                <?php $notice = 'font-weight-bold text-danger'; ?>
                                {{--<b>No Stock({{$attrs->size}})</b>--}}
                            @endif
                        @endforeach
                        <tr class="{{$notice}}">
                            <td>{{$i}}</td>
                            <td><img src="{{url('products/small',$product->image)}}" alt="" width="30"></td>
                            {{--<td>{{$product->p_name}}</td>--}}
                            <td>{{Str::limit($product->p_name, 15)}}</td>
                            <td>{{$product->category->name}}</td>
                            {{--<td>{{$product->p_code}}</td>--}}
                            {{--<td>{{$product->p_color}}</td>--}}
                            {{--<td>{{$product->price}}</td>--}}
                            <td style="vertical-align: middle;text-align: center;">
                                <a href="{{route('image-gallery.show',$product->id)}}"
                                   class="btn btn-outline-info border-0 btn-sm">Add Images</a>
                            </td>
                            <td style="vertical-align: middle;text-align: center;">
                                <a href="{{route('product_attr.show',$product->id)}}"
                                   class="btn btn-outline-info border-0 btn-sm">Add Attr</a>
                            </td>
                            <td>
                                <form action="{{ route('product.destroy',$product->id) }}" method="POST">
                                    {{--<a href="#myModal{{$product->id}}" data-toggle="modal" data-target="#myModal{{$product->id}}"--}}
                                       {{--class="btn btn-sm btn-outline-primary border-0">Show</a>--}}
                                    <a href="{{route('product.edit',$product->id)}}"
                                       class="btn btn-outline-primary border-0 btn-sm">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-sm btn-outline-danger border-0">Delete</button>
                                </form>
                            </td>
                        </tr>

                        <!-- The Modal -->
                        {{--<div class="modal fade" id="myModal{{$product->id}}">--}}
                            {{--<div class="modal-dialog">--}}
                                {{--<div class="modal-content">--}}

                                    {{--<!-- Modal Header -->--}}
                                    {{--<div class="modal-header">--}}
                                        {{--<h4 class="modal-title">{{$product->p_name}}</h4>--}}
                                        {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                                    {{--</div>--}}

                                    {{--<!-- Modal body -->--}}
                                    {{--<div class="modal-body">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-sm-5">--}}
                                                {{--<img src="{{url('products/small',$product->image)}}"--}}
                                                     {{--width="100" alt="{{$product->p_code}}">--}}
                                            {{--</div>--}}
                                            {{--<div class="col-sm-7">--}}
                                                {{--<h6>Description : </h6>--}}
                                                {{--<p>{!! $product->description !!}</p>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<!-- Modal footer -->--}}
                                    {{--<div class="modal-footer">--}}
                                        {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                                    {{--</div>--}}

                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    @endforeach
                    </tbody>
                </table>
                {!! $products->links() !!}
            </div>
        </div>
    </div>
@endsection

@section('jsblock')
@endsection