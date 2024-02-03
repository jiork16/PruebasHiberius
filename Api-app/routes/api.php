<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\VehicleController;
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

Route::get('vehicles',[VehicleController::class,'index'])->name('vehicle.index');
Route::get('vehicles/free/{date}',[VehicleController::class,'FreeVehicles'])->name('vehicle.free_vehicle');
Route::post('vehicles',[VehicleController::class,'store'])->name('vehicle.store');
Route::put('vehicles/{id}',[VehicleController::class,'update'])->name('vehicle.update');
Route::delete('vehicles/{id}',[VehicleController::class,'delete'])->name('vehicle.delete');

Route::get('drivers',[DriverController::class,'index'])->name('driver.index');
Route::get('drivers/free/{license}/{date}',[DriverController::class,'freeDrivers'])->name('driver.free_driver');
Route::post('drivers',[DriverController::class,'store'])->name('driver.store');
Route::put('drivers/{id}',[DriverController::class,'update'])->name('driver.update');
Route::delete('drivers/{id}',[DriverController::class,'delete'])->name('driver.delete');

Route::get('trips',[TripController::class,'index'])->name('trip.index');
Route::post('trips',[TripController::class,'store'])->name('trip.store');
Route::delete('trips/{vehicle_id}/{driver_id}/{date}',[TripController::class,'delete'])->name('trip.delete');


