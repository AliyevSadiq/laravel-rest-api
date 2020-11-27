<?php

use App\Http\Controllers\BlogController;

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/blog',[BlogController::class,'index']);

Route::get('/blog/{id}',[BlogController::class,'edit'])->middleware('blog');



Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);

Route::group(['middleware'=>'jwt.verify'],function (){
    Route::post('/blog/create',[BlogController::class,'create']);
    Route::post('/blog/{id?}',[BlogController::class,'update'])->middleware('blog');
    Route::delete('/blog/{id}',[BlogController::class,'delete'])->middleware('blog');
    Route::post('/refresh',[UserController::class,'refresh']);
});

