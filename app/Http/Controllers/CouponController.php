<?php

namespace App\Http\Controllers;

use App\Coupon_model;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(){
        $coupons=Coupon_model::all();
        return view('backEnd.coupon.index',compact('coupons'));
    }

    public function create(){
        return view('backEnd.coupon.create');
    }

    public function store(Request $request){
        $request->validate([
            'coupon_code'=>'required|min:5|max:15|unique:coupons,coupon_code',
            'amount'=>'required|numeric|between:1,99',
            'expiry_date'=>'required|date'
        ]);
        $input_data=$request->all();
        if(empty($input_data['status'])){
            $input_data['status']=0;
        }
        Coupon_model::create($input_data);
        return back()->with('success','Coupon added succesfully.');
    }

    public function show($id){
        //
    }

    public function edit($id){
        $edit_coupons=Coupon_model::findOrFail($id);
        return view('backEnd.coupon.edit',compact('edit_coupons'));
    }

    public function update(Request $request, $id){
        $update_coupon=Coupon_model::findOrFail($id);
        $request->validate([
            'coupon_code'=>'required|min:5|max:15',
            'amount'=>'required|numeric|between:1,99',
            'expiry_date'=>'required|date'
        ]);
        $input_data=$request->all();
        if(empty($input_data['status'])){
            $input_data['status']=0;
        }
        $update_coupon->update($input_data);
        return redirect()->route('coupon.index')->with('success','Coupon updated successfully !');
    }

    public function destroy($id){
        $delete_coupon=Coupon_model::findOrFail($id);
        $delete_coupon->delete();
        return back()->with('success','Coupon deleted successfully !');
    }

    public function applycoupon(Request $request){
        $request->validate([
            'coupon_code'=>'required'
        ]);
        $input_data=$request->all();
        $coupon_code=$input_data['coupon_code'];
        $total_amount_price=$input_data['Total_amountPrice'];
        $check_coupon=Coupon_model::where('coupon_code',$coupon_code)->count();
        if($check_coupon==0){
            return back()->with('message_coupon','Your Coupon Code Not Exist!');
        }else if($check_coupon==1){
            $check_status=Coupon_model::where('status',1)->first();
            if($check_status->status==0){
                return back()->with('message_coupon','Your Coupon was Disabled!');
            }else{
                $expiried_date=$check_status->expiry_date;
                $date_now=date('Y-m-d');
                if($expiried_date<$date_now){
                    return back()->with('message_coupon','Your Coupon was Expired!');
                }else{
                    $discount_amount_price=($total_amount_price*$check_status->amount)/100;
                    Session::put('discount_amount_price',$discount_amount_price);
                    Session::put('coupon_code',$check_status->coupon_code);
                    return back()->with('message_coupon','Your Coupon Code was Apply');
                }
            }
        }
    }
}
