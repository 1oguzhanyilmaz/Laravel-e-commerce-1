<?php

namespace App\Http\Controllers;

use App\Cart_model;
use App\Orders_model;
use App\ProductAttr_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    public function index(){
        $session_id = Session::get('session_id');
        $cart_datas = Cart_model::where('session_id',$session_id)->get();
        $total_price = 0;
        foreach ($cart_datas as $cart_data){
            $total_price += $cart_data->price * $cart_data->quantity;
        }
        $shipping_address = DB::table('delivery_address')->where('users_id',Auth::id())->first();
        return view('checkout.review_order',compact('shipping_address','cart_datas','total_price'));
    }
    public function order(Request $request){
        $input_data = $request->all();
        $payment_method = $input_data['payment_method'];
        // Orders_model::create($input_data);
        $order = Orders_model::create($input_data);
        // echo 'id : ' . $order->id;
        // die();
        $session_id = Session::get('session_id');
        $cart_datas = Cart_model::where('session_id',$session_id)->get();
        // update orders table -> paid = 1
        Orders_model::where('id',$order->id)->update(['paid'=>1]);
        // add products -> order_products table
        // update stock
        foreach ($cart_datas as $cart_data){
            DB::table('order_products')->insert([
                'order_id' => $order->id,
                'product_id' => $cart_data->products_id,
                'quantity' => $cart_data->quantity,
                'size' => $cart_data->size,
                'product_code' => $cart_data->product_code,
                'product_color' => $cart_data->product_color
            ]);
            $temp = ProductAttr_model::where([
                'products_id' => $cart_data->products_id,
                'sku' => $cart_data->product_code,
                'size' => $cart_data->size,
                'color' => $cart_data->product_color
            ])->first();
            $newStock = ($temp->stock) - ($cart_data->quantity);
            // echo 'new Stock_: ' . $newStock;
            ProductAttr_model::where('id', $temp->id)->update(['stock' => $newStock]);
        }
        if($payment_method == "COD"){
            return redirect('/cod');
        }else{
            return redirect('/paypal');
        }
    }
    public function cod(){
        $user_order = Orders_model::where('users_id',Auth::id())->first();
        return view('payment.cod',compact('user_order'));
    }
    public function paypal(Request $request){
        $who_buying = Orders_model::where('users_id',Auth::id())->first();
        return view('payment.paypal',compact('who_buying'));
    }

    ### Admin - Order List ###
    public function getOrders(){
        $orders = Orders_model::where('paid',1)->paginate(10);
        return view('backEnd.orders.index',compact('orders'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    public function completeOrder($id){
        Orders_model::where('id',$id)->update(['shipping'=>1]);
        return redirect('/admin/orders')->with('success','Shipped !');
    }
}
