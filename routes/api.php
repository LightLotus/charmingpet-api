<?php

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

//---Manners Route API
Route::get('manners', [MannerController::class, 'index']);
Route::post('addmanners', [MannerController::class, 'store']);
Route::get('/edit-manner/{id}', [MannerController::class, 'edit']);
Route::put('update-manner/{id}', [MannerController::class, 'update']);
Route::delete('delete-manner/{id}', [MannerController::class, 'destroy']);

//---Mannerenrolls Route API
Route::get('mannerenroll/{id}', [MannerenrollController::class, 'index']);
Route::post('addmannerenroll', [MannerenrollController::class, 'store']);