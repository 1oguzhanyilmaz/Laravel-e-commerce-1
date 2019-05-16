<?php

namespace App\Http\Controllers;

use App\Category_model;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category_model::all();
        return view('backEnd.category.index',compact('categories'));
    }

    public function create(){
        $plucked=Category_model::where('parent_id',0)->pluck('name','id');
        $cate_levels=['0'=>'Main Category']+$plucked->all();
        return view('backEnd.category.create',compact('cate_levels'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|max:255|unique:categories,name'
        ]);
        $data=$request->all();
        Category_model::create($data);
        return redirect()->route('category.index')->with('success','Added Success!');
    }

    public function show($id){
        echo $id;
    }

    public function edit($id){
        $plucked=Category_model::where('parent_id',0)->pluck('name','id');
        $cate_levels=['0'=>'Main Category']+$plucked->all();
        $edit_category=Category_model::findOrFail($id);
        return view('backEnd.category.edit',compact('edit_category','cate_levels'));
    }

    public function update(Request $request, $id){
        $update_categories=Category_model::findOrFail($id);
        $request->validate([
            'name'=>'required|max:255',
            'url'=>'required'
        ]);
        //dd($request->all());die();
        $input_data=$request->all();
        if(empty($input_data['status'])){
            $input_data['status']=0;
        }
        $update_categories->update($input_data);
        return redirect()->route('category.index')->with('success','Updated Success!');
    }

    public function destroy($id){
        $delete=Category_model::findOrFail($id);
        $delete->delete();
        return redirect()->route('category.index')->with('success','Delete Success!');
    }
}
