<?php

namespace App\Http\Controllers;

use App\ImageGallery_model;
use App\Products_model;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagesController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'image'=>'required'
        ]);

        $inputData=$request->all();
        if($request->file('image')){
            $images=$request->file('image');
            foreach ($images as $image){
                if($image->isValid()){
                    $extension=$image->getClientOriginalExtension();
                    $filename=rand(100,999999).time().'.'.$extension;
                    $large_image_path=public_path('products/large/'.$filename);
                    $medium_image_path=public_path('products/medium/'.$filename);
                    $small_image_path=public_path('products/small/'.$filename);
                    //// Resize Images
                    Image::make($image)->save($large_image_path);
                    Image::make($image)->resize(600,600)->save($medium_image_path);
                    Image::make($image)->resize(300,300)->save($small_image_path);
                    $inputData['image']=$filename;
                    ImageGallery_model::create($inputData);
                }
            }
        }
        return back()->with('success','Images uploaded successfully.');
    }

    public function show($id){
        $product=Products_model::findOrFail($id);
        $imageGalleries=ImageGallery_model::where('products_id',$id)->get();
        return view('backEnd.products.add_images_gallery',compact('product','imageGalleries'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id){
        $delete=ImageGallery_model::findOrFail($id);
        $image_large=public_path().'/products/large/'.$delete->image;
        $image_medium=public_path().'/products/medium/'.$delete->image;
        $image_small=public_path().'/products/small/'.$delete->image;
        if($delete->delete()){
            unlink($image_large);
            unlink($image_medium);
            unlink($image_small);
        }
        return back()->with('success','Image deleted successfully !');
    }
}
