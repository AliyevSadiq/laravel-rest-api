<?php

namespace App\Http\Middleware;

use App\Models\Blog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;


class BlogMiddleware
{



    private $route;

    public function __construct(Route $route)
    {
        $this->route=$route;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
    if(!isset($this->route->parameters['id'])){
        return response()->json(['error'=>true,'message'=>'BLOG NOT FOUND'],404);
    }
         $id=$this->route->parameters['id'];
         $blog=Blog::find($id);
        if(is_null($blog)){
            return response()->json(['error'=>true,'message'=>'BLOG NOT FOUND'],404);
        }




        return $next($request);
    }
}
