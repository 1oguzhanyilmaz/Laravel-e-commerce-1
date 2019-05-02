@extends('backEnd.layouts.app-backend')
@section('title','Edit Product')

@section('content')
    <div class="col-md-9">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/product">Products</a></li>
            <li class="breadcrumb-item active"><a href="#">Edit Product</a></li>
        </ol>
        <div class="card">
            <div class="card-header">Edit Product</div>
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
                <form action="{{route('product.update',$edit_product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="categories_id"><strong>Select Category</strong></label>
                        <select class="form-control" name="categories_id" id="categories_id">
                            @foreach($categories as $key => $value)
                                <option value="{{$key}}"{{$edit_category->id==$key?' selected':''}}>{{$value}}</option>
                                <?php
                                if($key!=0){
                                    $sub_categories=DB::table('categories')->select('id','name')->where('parent_id',$key)->get();
                                    if(count($sub_categories)>0){
                                        foreach ($sub_categories as $sub_category){?>
                                            <option value="{{$sub_category->id}}"{{$edit_category->id==$sub_category->id?' selected':''}}>&nbsp;&nbsp;--{{$sub_category->name}}</option>
                                        <?php }
                                    }
                                }
                                ?>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="p_name">Product Name:</label>
                        <input type="text" class="form-control" name="p_name" id="p_name" value="{{$edit_product->p_name}}">
                    </div>
                    <div class="form-group">
                        <label for="p_code">Code:</label>
                        <input type="text" class="form-control" name="p_code" id="p_code" value="{{$edit_product->p_code}}">
                    </div>
                    <div class="form-group">
                        <label for="p_color">Color:</label>
                        <input type="text" class="form-control" name="p_color" id="p_color" value="{{$edit_product->p_color}}">
                    </div>
                    <div class="form-group p-1">
                        <label for="description">Description:</label>
                        <textarea class="form-control textarea_editor" rows="5" id="description" name="description" placeholder="Product Description">{{$edit_product->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" name="price" id="price" value="{{$edit_product->price}}">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload Image</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Choose file</label><br>
                        </div>
                    </div>
                    @if($edit_product->image!='')
                        <p>Image : <img src="{{url('products/small/',$edit_product->image)}}" width="35" alt=""></p>
                    @endif
                    <button type="submit" class="btn btn-primary">Edit Product</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('jsblock')
@endsection