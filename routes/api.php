<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ServicesController;


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




Route::controller(ServicesController::class)->group(function () {
    Route::get('get-services-data', 'getservices_api')->name('get-services-data');
    Route::get('get-services-data-byid/{services_id}', 'getservice_api')->name('get-services-data-byid');
    Route::post('add-services-data', 'create_services_api')->name('add-services-data');
    Route::post('update-services-data/{services_id}', 'update_services_api')->name('update-services-data');
    Route::delete('delete-services-data/{services_id}', 'delete_services_api')->name('delete-services-data');

    
});

Route::controller(CountersController::class)->group(function(){
    Route::get('get-counters-data', 'getcounters_api')->name('get-counters-data');
    Route::post('add-counters-data', 'create_counters_api')->name('add-counters-data');

});