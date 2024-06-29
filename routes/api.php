<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PasswordResetController;
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

Route::post('/auth/password-forgot', [PasswordResetController::class, 'sendResetLink'])->middleware('guest');
Route::post('/auth/password-reset', [PasswordResetController::class, 'resetPassword'])->middleware('guest');
Route::post('/auth', [AuthController::class, 'auth']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/course/{id}', [CourseController::class, 'show']);

    Route::get('/course/{id}/modules',[ModuleController::class, 'index']);

    Route::get('/module/{id}/lessons',[LessonController::class, 'index']);
    Route::get('/lesson/{id}',[LessonController::class, 'show']);

    Route::post('/lesson/viewed',[LessonController::class, 'viewed']);

    Route::get('/supports/user',[SupportController::class, 'supportsUser']);
    Route::get('/supports',[SupportController::class, 'index']);
    Route::post('/support',[SupportController::class, 'store']);

    Route::post('/support/reply',[ReplySupportController::class, 'createReply']);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);

});

Route::get('/', function(){
    return response()->json([
        'success' => true
    ]);
});
