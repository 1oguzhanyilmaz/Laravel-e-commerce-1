@extends('backEnd.layouts.app-backend')
@section('title','Add Product Attribute')

@section('content')
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/product">Products</a></li>
                    <li class="breadcrumb-item active"><a href="#">Product Attribute</a></li>
                </ol>
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <p>Product : <b> {{$product->p_name}}</b></p>
                        <hr>
                        <p>Product Code : <b> {{$product->p_code}}</b></p>
                        <hr>
                        <p>Product Price : <b> {{$product->price}}</b></p>
                    </div>
                    <div class="card-body">
                        <form action="{{route('product_attr.update',$product->id)}}" method="POST" id="attrFrom">
                            @csrf
                            @method('PUT')
                            <table class="table small">
                                <thead>
                                <tr>
                                    <th style="width: 100px;">SKU</th>
                                    <th style="width: 75px;">Color</th>
                                    <th style="width: 75px;">Size</th>
                                    <th style="width: 75px;">Price</th>
                                    <th style="width: 75px;">Stock</th>
                                    <th style="">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($attributes as $attribute)
                                    <input type="hidden" name="id[]" value="{{$attribute->id}}">
                                    <tr class="p-0 m-0">
                                        <td class="p-0 m-0 mr-1">
                                            <input type="text" name="sku[]" id="sku" class="form-control form-control-sm" value="{{$attribute->sku}}">
                                        </td>
                                        <td class="p-0 m-0">
                                            <input type="text" name="color[]" id="color" class="form-control form-control-sm" value="{{$attribute->color}}">
                                        </td>
                                        <td class="p-0 m-0">
                                            <input type="text" name="size[]" id="size" class="form-control form-control-sm" value="{{$attribute->size}}">
                                        </td>
                                        <td class="p-0 m-0">
                                            <input type="text" name="price[]" id="price" class="form-control form-control-sm" value="{{$attribute->price}}">
                                        </td>
                                        <td class="p-0 m-0">
                                            <input type="text" name="stock[]" id="stock" class="form-control form-control-sm" value="{{$attribute->stock}}">
                                        </td>
                                        <td class="p-0 m-0">
                                            <a href="javascript:void(0)" onclick="editAnchorFunc();">Edit</a>
                                            <br>
                                            <a onclick="return confirm('Are you sure?')" href="/admin/delete-attribute/{{$attribute->id}}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Add Attribute</div>
                    <div class="card-body">
                        <form action="{{route('product_attr.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="products_id" value="{{$product->id}}">
                                <input type="text" class="form-control form-control-sm mb-2" name="sku" value="{{old('sku')}}" id="sku" placeholder="SKU">
                                <input type="text" class="form-control form-control-sm mb-2" name="color" value="{{old('color')}}" id="color" placeholder="Color">
                                <input type="text" class="form-control form-control-sm mb-2" name="size" value="{{old('size')}}" id="size" placeholder="Size">
                                <input type="text" class="form-control form-control-sm mb-2" name="price" value="{{old('price')}}" id="price" placeholder="Price">
                                <input type="number" class="form-control form-control-sm mb-2" name="stock" value="{{old('stock')}}" id="stock" placeholder="Stock">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsblock')
    <script>
        function editAnchorFunc(){
            $("#attrFrom").submit();
        }
    </script>
@endsection