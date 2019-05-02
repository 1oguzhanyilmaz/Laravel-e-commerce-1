<?php

namespace App\Http\Controllers;

use App\Category_model;
use App\Products_model;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(){
        $i=0;
        $products=Products_model::orderBy('created_at','desc')->get();
        return view('backEnd.products.index',compact('products','i'));
    }

    public function create(){
        $categories=Category_model::where('parent_id',0)->pluck('name','id')->all();
        return view('backEnd.products.create',compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'p_name'=>'required|min:5',
            'p_code'=>'required',
            'p_color'=>'required',
            'description'=>'required',
            'price'=>'required|numeric',
            'image'=>'required|image|mimes:png,jpg,jpeg|max:1000'
        ]);
        $formInput=$request->all();
        if($request->file('image')){
            $image=$request->file('image');
            if($image->isValid()){
                $fileName=time().'-'.str_slug($formInput['p_name'],"-").'.'.$image->getClientOriginalExtension();
                $large_image_path=public_path('products/large/'.$fileName);
                $medium_image_path=public_path('products/medium/'.$fileName);
                $small_image_path=public_path('products/small/'.$fileName);
                //Resize Image
                Image::make($image)->save($large_image_path);
                Image::make($image)->resize(600,600)->save($medium_image_path);
                Image::make($image)->resize(300,300)->save($small_image_path);
                $formInput['image']=$fileName;
            }
        }
        Products_model::create($formInput);
        return redirect()->route('product.index')->with('success','Product added successfully!');
    }

    public function show($id){
        //
    }

    public function edit($id){
        $categories=Category_model::where('parent_id',0)->pluck('name','id')->all();
        $edit_product=Products_model::findOrFail($id);
        $edit_category=Category_model::findOrFail($edit_product->categories_id);
        return view('backEnd.products.edit',compact('edit_product','categories','edit_category'));
    }

    public function update(Request $request, $id){
        $update_product=Products_model::findOrFail($id);
        $request->validate([
            'p_name'=>'required|min:5',
            'p_code'=>'required',
            'p_color'=>'required',
            'description'=>'required',
            'price'=>'required|numeric',
            'image'=>'image|mimes:png,jpg,jpeg|max:1000'
        ]);
        $formInput=$request->all();
        if ($request['image'] == ''){
            $formInput['image']=$update_product['image'];
        }else{
            if($request->file('image')){
                $image=$request->file('image');
                if($image->isValid()){
                    $fileName=time().'-'.str_slug($formInput['p_name'],"-").'.'.$image->getClientOriginalExtension();
                    $large_image_path=public_path('products/large/'.$fileName);
                    $medium_image_path=public_path('products/medium/'.$fileName);
                    $small_image_path=public_path('products/small/'.$fileName);
                    //Resize Image
                    Image::make($image)->save($large_image_path);
                    Image::make($image)->resize(600,600)->save($medium_image_path);
                    Image::make($image)->resize(300,300)->save($small_image_path);
                    $formInput['image']=$fileName;
                }
            }
        }
        $update_product->update($formInput);
        return redirect()->route('product.index')->with('success','Product updated successfully!');
    }

    public function destroy($id){
        $delete=Products_model::findOrFail($id);
        $image_large=public_path().'/products/large/'.$delete->image;
        $image_medium=public_path().'/products/medium/'.$delete->image;
        $image_small=public_path().'/products/small/'.$delete->image;
        if($delete->delete()){
            unlink($image_large);
            unlink($image_medium);
            unlink($image_small);
        }
        return redirect()->route('product.index')->with('success','Product deleted successfully!');
    }
}
