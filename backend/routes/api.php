<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/categories',[CategoryController::class, 'index']);


Route::get('/recipes',[RecipeController::class, 'index']);
Route::post('/recipes',[RecipeController::class, 'store']);
Route::get('/recipes/{recipe}',[RecipeController::class, 'show']);
Route::patch('/recipes/{recipe}',[RecipeController::class, 'update']);
Route::delete('/recipes/{recipe}',[RecipeController::class, 'destroy']);
Route::post('/recipes/upload',[RecipeController::class, 'upload']);
