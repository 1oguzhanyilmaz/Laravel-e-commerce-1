@extends('backEnd.layouts.app-backend')
@section('title','Users')

@section('content')
    <div class="col-md-9">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Users</a></li>
        </ol>
        <div class="card">
            <div class="card-header">
                Users
                <span class="float-right">
                    <a href="{{url('/admin/users/create')}}" class="btn btn-sm btn-success">Add New User</a><br>
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

                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Mobile</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="small">
                    @foreach($users as $user)
                        <?php $i++; ?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->admin == 1 ? 'Admin':'Normal User'}}</td>
                            <td>{{$user->mobile}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                <form action="{{url('/admin/users/'.$user->id)}}" method="POST">
                                    <a href="{{url('/admin/users/'.$user->id)}}"
                                       class="btn btn-sm btn-outline-primary border-0">Show</a>
                                    <a href="{{url('/admin/users/'.$user->id.'/edit')}}"
                                       class="btn btn-outline-primary border-0 btn-sm">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" type="submit"
                                            class="btn btn-sm btn-outline-danger border-0">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    {!! $users->links() !!}
            </div>
        </div>
    </div>
@endsection

@section('jsblock')
@endsection