<?php
// header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
// header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Accept,charset,boundary,Content-Length');
// header('Access-Control-Allow-Origin: *');

use App\Http\Controllers\API\AdoptionController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\MannerController;
use App\Http\Controllers\API\MannerenrollController;
use App\Http\Controllers\API\PuppyController;
use App\Http\Controllers\API\PuppyenrollController;
use App\Models\Puppyenroll;
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

//---Manners Route API (for class manner schedules)
Route::get('manners', [MannerController::class, 'index']);
Route::post('addmanners', [MannerController::class, 'store']);
Route::get('/edit-manner/{id}', [MannerController::class, 'edit']);
Route::put('update-manner/{id}', [MannerController::class, 'update']);
Route::delete('delete-manner/{id}', [MannerController::class, 'destroy']);

//---Puppy Class Route API (for class puppy schedules)
Route::get('puppies', [PuppyController::class, 'index']);
Route::post('addpuppies', [PuppyController::class, 'store']);
Route::get('/edit-puppies/{id}', [PuppyController::class, 'edit']);
Route::put('update-puppies/{id}', [PuppyController::class, 'update']);
Route::delete('delete-puppies/{id}', [PuppyController::class, 'destroy']);

//---Mannerenrolls Route API (for manner students)
Route::get('mannerenroll', [MannerenrollController::class, 'index']);
Route::post('addmannerenroll', [MannerenrollController::class, 'store']);
Route::get('editmannerenroll/{id}', [MannerenrollController::class, 'edit']);
Route::put('updatemannerenroll/{id}', [MannerenrollController::class, 'update']);
Route::delete('deletemannerenroll/{id}', [MannerenrollController::class, 'destroy']);

//---Puppyenrolls Route API (for puppy students)
Route::get('puppyenroll', [PuppyenrollController::class, 'index']);
Route::post('addpuppyenroll', [PuppyenrollController::class, 'store']);
Route::get('editpuppyenroll/{id}', [PuppyenrollController::class, 'edit']);
Route::put('updatepuppyenroll/{id}', [PuppyenrollController::class, 'update']);
Route::delete('deletepuppyenroll/{id}', [PuppyenrollController::class, 'destroy']);

//---ADOPTION Route API (Rescued animals)
Route::get('adoption', [AdoptionController::class, 'index']);
Route::post('addadoption', [AdoptionController::class, 'store']);
Route::get('editadoption/{id}', [AdoptionController::class, 'edit']);
Route::put('updateadoption/{id}', [AdoptionController::class, 'update']);
Route::delete('deleteadoption/{id}', [AdoptionController::class, 'destroy']);

//---CUSTOMER Route API (Interested User to adoption
Route::get('customer/{id}', [CustomerController::class, 'bax_lab_nica']);
Route::post('update-customer-status', [CustomerController::class, 'nica_lab_bax']);
Route::post('addcustomer', [CustomerController::class, 'store']);
Route::get('editcustomer/{id}', [CustomerController::class, 'edit']);
Route::put('updatecustomer/{id}', [CustomerController::class, 'update']);
Route::delete('deletecustomer/{id}', [CustomerController::class, 'destroy']);

// To protect the world from devastation! 
// To unite all peoples within our nation! 
// To denounce the evils of truth and love! To extend our reach to the stars above!
Route::group(['middleware' => ['auth:customer']], function () {
    // Route::post("user-login", "App\Http\Controllers\UserController@userLogin");
});

Route::post("user-login", "App\Http\Controllers\AdminController@userLogin");
Route::post("customer-login", "App\Http\Controllers\UserController@userLogin");
Route::post("customer-signup", "App\Http\Controllers\UserController@userSignUp");