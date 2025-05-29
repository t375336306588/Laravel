<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Building;
use App\Models\Activity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Информация об организации по ID
     */
    public function show($id): JsonResponse
    {
        $organization = Company::with(['building', 'activity'])
            ->findOrFail($id);
            
        return response()->json(['data' => $organization]);
    }

    /**
     * Организации в конкретном здании
     */
    public function building($buildingId): JsonResponse
    {
        $organizations = Company::with('activity')
            ->where('building_id', $buildingId)
            ->get();
            
        return response()->json(['data' => $organizations]);
    }

    /**
     * Организации по виду деятельности
     */
    public function activity($activityId): JsonResponse
    {
        $activityIds = $this->getActivityIdsWithChildren($activityId);
        
        $organizations = Company::whereIn('activity_id', $activityIds)
            ->get();
            
        return response()->json(['data' => $organizations]);
    }

    /**
     * Рекурсивно получаем ID вида деятельности и всех его потомков
     */
    protected function getActivityIdsWithChildren($activityId): array
    {
        $ids = [$activityId];
        
        // Получаем непосредственных детей
        $children = Activity::where('parent_id', $activityId)->get();
        
        foreach ($children as $child) {
            // Рекурсивно добавляем потомков
            $ids = array_merge($ids, $this->getActivityIdsWithChildren($child->id));
        }
        
        return $ids;
    }

    /**
     * Организации в заданной области
     */
    public function nearby(Request $request): JsonResponse
    {
        abort(500);
    }

    /**
     * Поиск организаций по виду деятельности (с учетом иерархии)
     */
    public function type(Request $request): JsonResponse
    {

        $request->validate(['name' => 'required|string|min:2']);
        
        $searchName = $request->name;
        
        // Поиск по названию вида деятельности
        $activities = Activity::where('name', 'like', "%$searchName%")->get();
        
        $activityIds = [];
        foreach ($activities as $activity) {
            // Получаем все дочерние элементы
            $ids = Activity::where('path', 'like', $activity->path . '%')
                ->pluck('id')
                ->toArray();
            $activityIds = array_merge($activityIds, $ids);
        }
        
        $activityIds = array_unique($activityIds);
        
        $organizations = Company::whereIn('activity_id', $activityIds)
            ->with(['building', 'activity'])
            ->get();
            
        return response()->json(['data' => $organizations]);
    }

    /**
     * Поиск организаций по названию
     */
    public function name(Request $request): JsonResponse
    {
        $request->validate(['name' => 'required|string|min:2']);
        
        $organizations = Company::where('name', 'like', '%' . $request->name . '%')
            ->with(['building', 'activity'])
            ->get();
            
        return response()->json(['data' => $organizations]);
    }
}