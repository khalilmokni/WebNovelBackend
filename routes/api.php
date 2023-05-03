<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NovelController;

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


Route::post('/login', [LoginController::class, 'login']);

/*Route::middleware('auth:sanctum')->group( function () {
    Route::post('/getAllNovels', [NovelController::class, 'showAllnovels']);
});*/
Route::post('/getAllNovels', [NovelController::class, 'getAllNovels']);
Route::post('/getTopThreeNovels', [NovelController::class, 'getTopThreeNovels']);
Route::post('/getNewNovels', [NovelController::class, 'getNewNovels']);
Route::post('/getTopThreeNovelsPower', [NovelController::class, 'getTopThreeNovelsPower']);
Route::post('/getTopThreeNovelsReaders', [NovelController::class, 'getTopThreeNovelsReaders']);
Route::post('/getWeeklyNovels', [NovelController::class, 'getWeeklyNovels']);
Route::post('/getUserGifts', [NovelController::class, 'getUserGifts']);
