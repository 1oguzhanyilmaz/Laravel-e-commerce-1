@extends('backEnd.layouts.app-backend')
@section('title','Products')

@section('content')
    <div class="col-md-9">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active"><a href="/admin/product">Products</a></li>
        </ol>
        <div class="card">
            <div class="card-header">Products</div>
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
                        <th>Code Of Product</th>
                        <th>Product Color</th>
                        <th>Price</th>
                        <th>Image Gallery</th>
                        <th>Add Attribute</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="small">
                    @foreach($products as $product)
                        <?php $i++; ?>
                        <tr>
                            <td>{{$i}}</td>
                            <td><img src="{{url('products/small',$product->image)}}" alt="" width="50"></td>
                            <td>{{$product->p_name}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->p_code}}</td>
                            <td>{{$product->p_color}}</td>
                            <td>{{$product->price}}</td>
                            <td style="vertical-align: middle;text-align: center;">
                                <a href="" class="btn btn-default btn-mini">Add Images</a>
                            </td>
                            <td style="vertical-align: middle;text-align: center;">
                                <a href="" class="btn btn-success btn-mini">Add Attr</a>
                            </td>
                            <td>
                                <form action="{{ route('product.destroy',$product->id) }}" method="POST">
                                    {{--<a class="btn btn-sm btn-outline-dark border-0" href="{{ route('posts.show',$post->id) }}">Show</a>--}}
                                    <a href="{{route('product.edit',$product->id)}}" class="btn btn-outline-primary border-0 btn-sm">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-sm btn-outline-danger border-0">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('jsblock')
@endsection