<?php

use Illuminate\Support\Facades\Route;
use App\Models\Test;
use App\Http\Controllers\Api\DataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-db', function () {
    try {

        Test::create(['name' => 'First entry', 'description' => 'SQLite test']);

        // Получение записей
        $items = Test::all();
        dd($items);

        DB::connection()->getPdo();
        return response()->json([
            'status' => 'success',
            'message' => 'Connected to SQLite database: ' . DB::connection()->getDatabaseName()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Could not connect: ' . $e->getMessage()
        ], 500);
    }
});
//*/
