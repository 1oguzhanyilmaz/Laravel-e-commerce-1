@extends('backEnd.layouts.app-backend')
@section('title','Edit Category')

@section('content')
    <div class="col-md-9">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/category">Categories</a></li>
            <li class="breadcrumb-item active"><a href="#">Edit Category</a></li>
        </ol>
        <div class="card">
            <div class="card-header">Edit Category</div>
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
                <form action="{{route('category.update',$edit_category->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Category Name:</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$edit_category->name}}">
                    </div>
                    <div class="form-group">
                        <label for="category"><strong>Category Level</strong></label>
                        <select class="form-control" name="parent_id" id="parent_id">
                            @foreach($cate_levels as $key => $value)
                                <option value="{{$key}}"{{($edit_category->parent_id==$key)? ' selected':''}}>{{$value}}</option>
                                <?php
                                if($key!=0){
                                    $subCategory=DB::table('categories')->select('id','name')->where('parent_id',$key)->get();
                                    if(count($subCategory)>0){
                                        foreach ($subCategory as $subCate){
                                            echo '<option value="'.$subCate->id.'">&nbsp;&nbsp;--'.$subCate->name.'</option>';
                                        }
                                    }
                                }
                                ?>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" name="description" id="description" value="{{$edit_category->description}}">
                    </div>
                    <div class="form-group">
                        <label for="url">URL (Start with http://) :</label>
                        <input type="text" class="form-control" name="url" id="url" value="{{$edit_category->url}}">
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="status" id="status"
                                   value="1" {{($edit_category->status==0)?'':'checked'}}>Enable
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('jsblock')

@endsection