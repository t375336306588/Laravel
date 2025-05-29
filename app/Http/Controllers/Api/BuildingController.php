<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Building;
use Illuminate\Http\JsonResponse;

class BuildingController extends Controller
{
    /**
     * Список всех зданий
     */
    public function index(): JsonResponse
    {
        $buildings = Building::all();
        return response()->json(['data' => $buildings]);
    }
}