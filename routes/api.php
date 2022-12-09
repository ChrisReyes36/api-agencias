<?php

use App\Http\Controllers\api\AgenciaController;
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

Route::group(['prefix' => 'agencias'], function () {
  Route::get('/', [AgenciaController::class, 'index']);
  Route::post('/', [AgenciaController::class, 'store']);
  Route::get('/{agencia_id}', [AgenciaController::class, 'show']);
  Route::put('/{agencia_id}', [AgenciaController::class, 'update']);
  Route::delete('/{agencia_id}', [AgenciaController::class, 'destroy']);
});
