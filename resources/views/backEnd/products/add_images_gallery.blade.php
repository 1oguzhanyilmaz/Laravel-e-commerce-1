@extends('backEnd.layouts.app-backend')
@section('title','Add Product Image')

@section('content')
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/product">Products</a></li>
                    <li class="breadcrumb-item active"><a href="#">Add Product Image</a></li>
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
                        <p>Product Color : <b> {{$product->p_color}}</b></p>
                    </div>
                    <div class="card-body">
                        <table class="table small">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($imageGalleries as $imageGallery)
                                <tr class="p-0 m-0">
                                    <td class="p-0 m-0 mr-1">
                                        {{$i++}}
                                    </td>
                                    <td class="p-0 m-0">
                                        <img src="{{url('products/small',$imageGallery->image)}}" class="img-responsive" alt="Image" width="50">                                        </td>
                                    <td class="p-0 m-0">
                                        <form action="{{route('image-gallery.destroy',$imageGallery->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure ?')" type="submit" class="btn btn-sm btn-outline-danger border-0">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Add Images</div>
                    <div class="card-body">
                        <form action="{{route('image-gallery.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="products_id" value="{{$product->id}}">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload Image</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="id_imageGallery" name="image[]" multiple="multiple">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsblock')
@endsection