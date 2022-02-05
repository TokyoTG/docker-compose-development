<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index(){
        $products = Product::all();
        return response()->json(['status' => 'success','data' => $products]);
    }


    public function show($id){
        $product = Product::find($id);
        if($product){
            return response()->json(['status' => 'success','data' => $product]);
        }
        return response()->json(['status' => 'success','data' => []]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'price' => 'required|integer',
            'name' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['status' => 'error','message' => 'validation failed']);
        }
        $product = new Product();
        $product->price = $request->price;
        $product->name = $request->name;
        $product->save();
        return response()->json(['status' => 'success','data' => $product]);
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'price' => 'required|integer',
            'name' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['status' => 'error','message' => 'validation failed']);
        }
        $product = Product::find($id);
        if(!$product){
            return response()->json(['status' => 'error','message' => 'product not found']);
        }
        $product->price = $request->price;
        $product->name = $request->name;
        $product->save();
        return response()->json(['status' => 'success','data' => $product]);
    }

    public function delete(Request $request,$id){
        $product = Product::find($id);
        if($product){
            $product->delete();
            return response()->json(['status' => 'success','data' => $product,'message' => 'product deleted']);
        }
        return response()->json(['status' => 'error','message' => 'product not found']);
 
    }

}
