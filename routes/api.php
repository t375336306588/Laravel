<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\BuildingController;
use App\Http\Controllers\Api\ActivityController;


Route::middleware('api.key')->group(function () {

    // Поиск организаций по виду деятельности (с учетом иерархии)
    Route::get('/company/type', [CompanyController::class, 'type']);

    // Организации в заданной области
    Route::get('/company/nearby', [CompanyController::class, 'nearby']);


    // Информация об организации по ID
    Route::get('/company/{id}', [CompanyController::class, 'show']);

    // Организации в конкретном здании
    Route::get('/company/building/{buildingId}', [CompanyController::class, 'building']);

    // Организации по виду деятельности
    Route::get('/company/activity/{activityId}', [CompanyController::class, 'activity']);

    // Поиск организаций по названию
    Route::get('/company/name', [CompanyController::class, 'name']);
    
    // Здания
    Route::get('/buildings', [BuildingController::class, 'index']);
});

