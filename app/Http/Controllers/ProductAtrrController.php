<?php

namespace App\Http\Controllers;

use App\ProductAttr_model;
use App\Products_model;
use Illuminate\Http\Request;

class ProductAtrrController extends Controller
{
    public function index(){
        //
    }

    public function create(){
        //
    }

    public function store(Request $request){
        $request->validate([
            'sku'=>'required',
            'size'=>'required',
            'price'=>'required|numeric|between:0,99.99',
            'stock'=>'required|numeric'
        ]);
        ProductAttr_model::create($request->all());
        return back()->with('success','Product attribute added succesfully.');
    }

    public function show($id){
        $attributes=ProductAttr_model::where('products_id',$id)->get();
        $product=Products_model::findOrFail($id);
        return view('backEnd.products.add_pro_atrr',compact('product','attributes'));
    }

    public function edit($id){
        //
    }

    public function update(Request $request, $id){
        $request_data=$request->all();
        foreach ($request_data['id'] as $key => $attr){
            $update_attr=ProductAttr_model::where([
                ['products_id',$id],
                ['id',$request_data['id'][$key]]
            ])->update([
                'sku'=>$request_data['sku'][$key],
                'size'=>$request_data['size'][$key],
                'price'=>$request_data['price'][$key],
                'stock'=>$request_data['stock'][$key]]
            );
        }
        return back()->with('success','Attribute updated succesfully.');
    }

    public function destroy($id){

    }

    public function deleteAttr($id){
        $deleteAttr=ProductAttr_model::findOrFail($id);
        $deleteAttr->delete();
        return back()->with('success','Attribute Deleted Successfull!');
    }
}
