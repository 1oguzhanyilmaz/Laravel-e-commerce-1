@extends('backEnd.layouts.app-backend')
@section('title','Create Products')

@section('content')
    <div class="col-md-9">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/product">Products</a></li>
            <li class="breadcrumb-item active"><a href="#">Add New Product</a></li>
        </ol>
        <div class="card">
            <div class="card-header">Add New Product</div>
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
                <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="categories_id"><strong>Select Category</strong></label>
                        <select class="form-control" name="categories_id" id="categories_id">
                            @foreach($categories as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                                <?php
                                if($key!=0){
                                    $sub_categories=DB::table('categories')->select('id','name')->where('parent_id',$key)->get();
                                    if(count($sub_categories)>0){
                                        foreach ($sub_categories as $sub_category){
                                            echo '<option value="'.$sub_category->id.'">&nbsp;&nbsp;--'.$sub_category->name.'</option>';
                                        }
                                    }
                                }
                                ?>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="p_name">Product Name:</label>
                        <input type="text" class="form-control" name="p_name" id="p_name" value="{{old('p_name')}}">
                    </div>
                    <div class="form-group">
                        <label for="p_code">Code:</label>
                        <input type="text" class="form-control" name="p_code" id="p_code" value="{{old('p_code')}}">
                    </div>
                    <div class="form-group">
                        <label for="p_color">Color:</label>
                        <input type="text" class="form-control" name="p_color" id="p_color" value="{{old('p_color')}}">
                    </div>
                    <div class="form-group p-1">
                        <label for="description">Description:</label>
                        <textarea class="form-control textarea_editor" rows="5" id="description" name="description" placeholder="Product Description">{{old('description')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" name="price" id="price" value="{{old('price')}}">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload Image</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add New Product</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('jsblock')
@endsection