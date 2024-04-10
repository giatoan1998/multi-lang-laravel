<?php

use App\Http\Controllers\DataTagsController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::post('/upload-file', [UploadFileController::class, 'uploadFile']);
Route::get('/data-tags', [DataTagsController::class, 'getTags']);
Route::post('/save-tags', function (Request $request) {
    DB::table('tags')->where('id', 1)->update(['tags' => $request->data]);
    return response()->json([
        'status' => 1
    ]);
});

Route::get('/data-users', [UserController::class, 'getUsers']);

Route::get('/data-lists', [ListsController::class, 'getLists']);
Route::post('/update-data-lists', [ListsController::class, 'updateLists']);

Route::get('/export-excel', [UserController::class, 'exportExcel']);
Route::get('/export-pdf', [UserController::class, 'exportPdf']);
