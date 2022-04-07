<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\InstallationController;
use App\Http\Controllers\API\Report_InstallationController;
use App\Http\Controllers\API\TechnicianController;
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

Route::post('user/signin', [AuthController::class, 'signin']);
Route::post('user/signup', [AuthController::class, 'signup']);
Route::post('instalasi', [InstallationController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('report_instalasi/{id}/uploadPhoto', [Report_InstallationController::class, 'uploadFoto']);
    Route::post('report_instalasi/{id}/uploadPhotoBast', [Report_InstallationController::class, 'uploadFotoBast']);
    Route::post('report_instalasi/{id}/uploadVideo', [Report_InstallationController::class, 'uploadVideo']);
    Route::get('report_instalasi/{id}', [Report_InstallationController::class, 'show']);
    Route::post('report_instalasi/{id}', [Report_InstallationController::class, 'store']);
    Route::post('report_instalasi-save/{id}', [Report_InstallationController::class, 'storeSave']);
    Route::get('instalasi', [InstallationController::class, 'index']);
    Route::get('instalasi/{id}', [InstallationController::class, 'show']);
    Route::post('instalasi/{id}', [InstallationController::class, 'update']);
    Route::delete('instalasi/{id}', [InstallationController::class, 'destroy']);
    Route::get('total-instalasi', [InstallationController::class, 'countData']);
    
    Route::get('report_instalasi', [Report_InstallationController::class, 'index']);
    Route::get('report_instalasi-check_data/{id}', [Report_InstallationController::class, 'checkData']);
    Route::get('report_instalasi-foto/{id}', [Report_InstallationController::class, 'checkFoto']);
    Route::get('report_instalasi-foto-bast/{id}', [Report_InstallationController::class, 'checkFotoBast']);
    Route::get('report_instalasi-video/{id}', [Report_InstallationController::class, 'checkVideo']);
    Route::post('report_instalasi', [Report_InstallationController::class, 'store']);
    Route::delete('report_instalasi/{id}', [Report_InstallationController::class, 'destroy']);
    Route::post('report_instalasi/{id}/component', [Report_InstallationController::class, 'componentCheckbox']);
    Route::get('report_instalasi/{id}/component/{comp_id}', [Report_InstallationController::class, 'showComp']);
    
    Route::get('technician', [TechnicianController::class, 'getIndex']);

    Route::post('user/logout', [AuthController::class, 'logout']);
    Route::get('user/{name}', [AuthController::class, 'getIdUser']);
});
