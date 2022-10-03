<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Resources\CoutryCollection;
use Illuminate\Support\Facades\DB;

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

Route::get('/countries', function () {
    return new CoutryCollection(DB::table('country')->get());
});

Route::get('/countries/{country}/states', function ($id) {
    return new CoutryCollection(DB::table('state')->where('country_id', '=', $id)->get());
});

Route::get('/state/{state}/cities', function ($id) {
    return new CoutryCollection(DB::table('city')->where('state_id', '=', $id)->get());
});