<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyApiKey
{
    public function handle(Request $request, Closure $next)
    {
        // Получение ключа из конфигурации
        $validApiKey = config('app.api_key');
        
        // Проверка наличия ключа в конфиге
        if (empty($validApiKey)) {
            abort(500, 'API key not configured');
        }

        // Получение ключа из запроса (заголовок или параметр)
        $apiKey = $request->header('X-API-KEY') ?? $request->input('api_key');
        
        // Проверка валидности ключа
        if ($apiKey !== $validApiKey) {
            return response()->json([
                'error' => 'Invalid API key',
                'message' => 'Unauthorized access'
            ], 401);
        }

        return $next($request);
    }
}