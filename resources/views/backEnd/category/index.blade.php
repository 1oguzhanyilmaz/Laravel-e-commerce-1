@extends('backEnd.layouts.app-backend')
@section('title','Categories')

@section('content')
<div class="col-md-9">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
        <li class="breadcrumb-item active"><a href="/admin/category">Categories</a></li>
    </ol>
    <div class="card">
        <div class="card-header">
            Categories
            <span class="float-right">
                <a href="{{url('/admin/category/create')}}" class="btn btn-sm btn-success">Add New Category</a><br>
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
            <table class="table">
                <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Parent Category</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="small">
                @foreach($categories as $category)
                    <?php
                    $parent_cates = DB::table('categories')->select('name')->where('id',$category->parent_id)->get();
                    ?>
                    <tr>
                        <td>{{$category->name}}</td>
                        <td>
                            @foreach($parent_cates as $parent_cate)
                                {{$parent_cate->name}}
                            @endforeach
                        </td>
                        <td>{{$category->created_at->diffForHumans()}}</td>
                        <td>{{($category->status==0)?' Disabled':'Enable'}}</td>
                        <td>
                            <form action="{{ route('category.destroy',$category->id) }}" method="POST">
                                {{--<a class="btn btn-sm btn-outline-dark border-0" href="{{ route('posts.show',$post->id) }}">Show</a>--}}
                                <a href="{{route('category.edit',$category->id)}}" class="btn btn-outline-primary border-0 btn-sm">Edit</a>
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