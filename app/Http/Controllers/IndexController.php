<?php

namespace App\Http\Controllers;

use App\Category_model;
use App\ImageGallery_model;
use App\ProductAttr_model;
use App\Products_model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(){
        $products = Products_model::paginate(24);
        return view('frontEnd.index',compact('products'));
    }
    public function listByCat($id){
        $queries = [];
        $pro_attr = new ProductAttr_model;
        if (request()->has('color')){
            $colorArr = explode(',', request('color'));
            $pro_attr = $pro_attr->whereIn('color', $colorArr);
            $queries['color'] = request('color');
        }
        $pro_attr = $pro_attr->get();
        $id_arr = [];
        foreach ($pro_attr as $attr){
            // echo 'id:'.$attr->products_id.'<br>';
            if (!in_array($attr->products_id,$id_arr)){
                $id_arr = Arr::add($id_arr,$attr->products_id,$attr->products_id);
            }
        }
        // get products
        $products = new Products_model;
        if (request()->has('sort')){
            $products = $products->orderBy('price', request('sort'));
            $queries['sort'] = request('sort');
        }
        $products = $products->where('categories_id', $id);
        $products = $products->whereIn('id', $id_arr);
        $products = $products->paginate(12)->appends($queries);

        $list_product = Products_model::where('categories_id',$id)->get();
        $colorArray = [];
        foreach ($list_product as $product){
            foreach ($product->attributes as $attr){
                if (!in_array($attr->color,$colorArray)){
                    $colorArray = Arr::add($colorArray, $attr->color, $attr->color);
                }
            }
        }
        $byCate = Category_model::select('name')->where('id',$id)->first();
        return view('frontEnd.products',compact('list_product','byCate','colorArray','products'));
    }

    public function filterProducts(Request $request){
        $data = $request->all();
        $temp_filter = [];
        $nameArr = [
            'priceSortFilter','colorFilter'
        ];
        foreach ($nameArr as $name){
            if (!empty($data[$name])){
                $url_tut = '';
                foreach ($data[$name] as $n){
                    if ($name == 'priceSortFilter'){
                        $url_tut = (empty($url_tut)) ? 'sort='.$n : $url_tut.','.$n;
                    }
                    if ($name == 'colorFilter'){
                        $url_tut = (empty($url_tut)) ? 'color='.$n : $url_tut.','.$n;
                    }
                }
                $temp_filter = Arr::add($temp_filter,$name,$url_tut);
            }
        }
        $url_more = '';
        foreach ($temp_filter as $temp){
            if ($url_more){
                $url_more = $url_more . '&' . $temp;
            }else{
                $url_more .= $temp;
            }
        }
        // echo '$url_more : ' . $url_more; die();
        $final_url = $data['url']."?".$url_more;
        // echo 'final_more : ' . $final_url; die();
        return redirect($final_url);
    }

    public function listProducts(){
        $products = Products_model::all();
        $byCate="";
        return view('frontEnd.products',compact('products','byCate'));
    }
    public function detailpro($id){
        $detail_product = Products_model::findOrFail($id);
        $imagesGalleries = ImageGallery_model::where('products_id',$id)->get();
        $totalStock = ProductAttr_model::where('products_id',$id)->sum('stock');
        $price = ProductAttr_model::where('products_id', $id)->first();
//        $product=ProductAttr_model::where('products_id',$id)->get();
//        // $stock['size'] = 12;
//        foreach ($product as $stock){
//            $temp = 1;
//        }
        $relateProducts = Products_model::where([['id','!=',$id],['categories_id',$detail_product->categories_id]])->get();
        return view('frontEnd.product_details',compact('detail_product','imagesGalleries','totalStock','relateProducts','price'));
    }

    public function ajaxStock(Request $request){
        $input = $request->all();
        $product_array = explode("-",$input['product_id_size']);
        $product_id = $product_array[0];
        $product_size = $product_array[1];
        $product_stock = ProductAttr_model::where([
            ['products_id',$product_id],
            ['size',$product_size]
        ])->get();
        // $stock = $product_stock->stock;

        $info_stock_color = '';
        $price = '';
        foreach ($product_stock as $pro){
            $price = $pro->price;
            $info_stock_color = $info_stock_color.'<b>Color : </b>'.$pro->color.'&nbsp;&nbsp;&nbsp;<b> Stock : </b>'.$pro->stock.'<br>';
        }

        return response()->json([
            'product_id'=>$product_id,
            'product_size'=>$product_size,
            'info_stock_color'=>$info_stock_color,
            'price'=>$price,
            'success'=>'Got Simple Ajax Request.'
        ]);
    }
}
