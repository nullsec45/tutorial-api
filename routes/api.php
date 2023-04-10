<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, BlogController};

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(["middleware" => "api"], function($router){
    // Route::post("/auth/signup",[AuthController::class,"signup"]);
    Route::prefix("auth")->group(function(){
         Route::post("signup",[AuthController::class,"signup"]);
         Route::post("signin",[AuthController::class,"signin"]);
    });
});

// Route::group(['prefix' => 'auth'], function () {
//     Route::post('/signup', [AuthController::class,"signup"])->name("auth.signup");
//     // Route::post('/register', 'UsersController@register');
//     // Route::get('/test', );
// });

// Route::group([
//     "middleware" => "api"
// ], function($router){
//     Route::prefix("auth")->group(function(){
//         Route::post("signup", [AuthcController::class,"signup"]);
//     });
// });
// Route::resource('blogs', BlogController::class);
// Route::get("/test", [AuthController::class, "test"]);