<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(){
        return Products::all();
    }
    public function store(Request $request){
        $fields = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'pricing'=> 'required'

        ]);
        $product = Products::create($fields);
        return response([
            'message' => 'Product Created Successfully',
            'product' => $product
        ]);
    }
    public function show($id){
        return Products::find($id);
    }
    public function update(Request $request, $id){
            $fields = $request->validate([
                'name' => 'required',
                'slug' => 'required',
                'description' => 'required',
                'pricing' => 'required'
            ]);
            $product = Products::find($id);
            $product->update($fields);
            return $product;
    }
    public function destroy($id){
        $product = Products::destroy($id);
        return($product);
    }
    public function search($name){
      $product =  Products::where('name', 'like', '%'.$name.'%')->get();
        return ($product);
    }
}
