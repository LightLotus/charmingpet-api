<?php

use App\Http\Controllers\API\AdoptionController;
use App\Http\Controllers\API\MannerController;
use App\Http\Controllers\API\MannerenrollController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//---Manners Route API (for class schedules)
Route::get('manners', [MannerController::class, 'index']);
Route::post('addmanners', [MannerController::class, 'store']);
Route::get('/edit-manner/{id}', [MannerController::class, 'edit']);
Route::put('update-manner/{id}', [MannerController::class, 'update']);
Route::delete('delete-manner/{id}', [MannerController::class, 'destroy']);

//---Mannerenrolls Route API (for students)
Route::get('mannerenroll', [MannerenrollController::class, 'index']);
Route::post('addmannerenroll', [MannerenrollController::class, 'store']);
Route::get('editmannerenroll/{id}', [MannerenrollController::class, 'edit']);
Route::put('updatemannerenroll/{id}', [MannerenrollController::class, 'update']);
Route::delete('deletemannerenroll/{id}', [MannerenrollController::class, 'destroy']);

//---Adoption Route API (Rescued animals)
Route::get('adoption', [AdoptionController::class, 'index']);
Route::post('addadoption', [AdoptionController::class, 'store']);
Route::get('editadoption/{id}',[AdoptionController::class, 'edit']);
Route::put('updateadoption/{id}', [AdoptionController::class, 'update']);
Route::delete('deleteadoption/{id}', [AdoptionController::class, 'destroy']);