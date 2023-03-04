<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\RoleController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/v1/register', [RegistrationController::class, 'postRegister'])->name('api.v1.register');

Route::put('/v1/organizations/members/roles', [RoleController::class, 'update'])->name('api.v1.organizations.members.roles');
Route::post('/v2/post',[PostController::class, 'store'])->name('api.v2.post');
Route::put('/v2/post',[PostController::class, 'update'])->name('api.v2.post');
