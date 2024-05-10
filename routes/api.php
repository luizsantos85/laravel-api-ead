<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\ReplySupportController;

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

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/course/{id}', [CourseController::class, 'show']);

Route::get('/course/{id}/modules',[ModuleController::class, 'index']);

Route::get('/module/{id}/lessons',[LessonController::class, 'index']);
Route::get('/lesson/{id}',[LessonController::class, 'show']);

Route::get('/supports',[SupportController::class, 'index']);
Route::post('/support',[SupportController::class, 'store']);
// Route::get('/support/{id}',[SupportController::class, 'show']);
Route::post('/support/reply',[ReplySupportController::class, 'createReply']);


Route::get('/', function(){
    return response()->json([
        'success' => true
    ]);
});
