@extends('backEnd.layouts.app-backend')
@section('title','Coupons')

@section('content')
    <div class="col-md-9">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active"><a href="/admin/coupon">Coupons</a></li>
        </ol>
        <div class="card">
            <div class="card-header">Coupons</div>
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
                        <th>ID</th>
                        <th>Coupon Code</th>
                        <th>Amount</th>
                        <th>Amount Type</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="small">
                    <?php $i=0; ?>
                    @foreach($coupons as $coupon)
                        <?php $i++; ?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$coupon->coupon_code}}</td>
                            <td>{{$coupon->amount}} %</td>
                            <td>{{$coupon->amount_type}}</td>
                            <td>{{$coupon->expiry_date}}</td>
                            <td>{{$coupon->status==1?'Active':'Disable'}}</td>
                            <td>
                                <form action="{{ route('coupon.destroy',$coupon->id) }}" method="POST">
                                    {{--<a class="btn btn-sm btn-outline-dark border-0" href="{{ route('posts.show',$post->id) }}">Show</a>--}}
                                    <a href="{{route('coupon.edit',$coupon->id)}}" class="btn btn-outline-primary border-0 btn-sm">Edit</a>
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