<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    function index(){
        return Category::all();
    }

    function show($id){
        return Category::findOrFail($id);
    }

    function store(Request $request){
        $request->validate([
            'name' => 'required|max:50|unique:categories'
        ]);
    
        $name=$request->input('name');
        $category=new Category();
        $category->name =$name;
        $category->save();
    }
    

    function edit(Request $request,$id){
        $request->validate([
            'name' => 'required|max:50|unique:categories'
        ]);
    
        $name=$request->input('name');
        $category=Category::findOrFail($id);
        $category->name =$name;
        $category->save();

    }
    

    function destroy($id){
        $category=Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
