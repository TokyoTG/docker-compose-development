<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{

    public function index(){
        $authors = Author::paginate(10);
        return response()->json(['status' => 'success', 'data' => $authors]);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['status' => 'error','message' => 'validation failed', 'messages' => $validator->errors()]);
        }
        $author = new Author();
        $author->name = $request->name;
        $author->save();
        return response()->json(['status' => 'success', 'data' => $author]);
    }


    public function update(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['status' => 'error','message' => 'validation failed', 'messages' => $validator->errors()]);
        }
        $author = Author::find($id);
        if(!$author){
            return response()->json(['status' => 'error','message' => 'author not found']);
        }
        $author->name = $request->name;
        $author->save();
        return response()->json(['status' => 'success', 'data' => $author]);
    }
}