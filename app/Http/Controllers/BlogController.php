<?php

namespace App\Http\Controllers;


use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index(){

            return response()->json(Blog::all(),200);

    }

    public function create(Request $request){
         if($request->method()=='POST'){
              $validator=Validator::make($request->all(),Blog::$rules,Blog::$errorMsg);

             if($validator->fails()){
                 return response()->json($validator->errors(),400);
             }

              $blog=Blog::create($request->all());
              return response()->json($blog,201);
         }
    }

    public function edit($id){

        $blog=Blog::find($id);
        return response()->json($blog,200);
    }

    public function update(Request $request,$id){

      if($request->method()=='POST'){




          $blog=Blog::find($id);
          $validator=Validator::make($request->all(),Blog::$rules,Blog::$errorMsg);
          if($validator->fails()){
              return response()->json($validator->errors(),400);
          }
          $blog->update([
              'title'=>$request->input('title'),
              'content'=>$request->input('content'),
          ]);
          return response()->json($blog,201);
      }

    }

    public function delete(Request $request,$id){
        if($request->method()=='DELETE'){
            $blog=Blog::find($id);
            $blog->delete();
            return response()->json('THIS BLOG IS DELETED',200);
        }

    }

}
