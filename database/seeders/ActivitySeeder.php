<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        // Создаем корневые элементы
        $root1 = Activity::factory()->create(['name' => 'Еда']);
        $root2 = Activity::factory()->create(['name' => 'Автомобили']);
        
        $roots = [$root1, $root2];
        
        
        
        // Создаем дочерние элементы (2 уровня)
        foreach ($roots as $root) {
            $children = Activity::factory(3)
                ->withParent($root->id)
                ->create();
            
            foreach ($children as $child) {
                
                
                // Создаем элементы 3-го уровня
                $grandChildren = Activity::factory(2)
                    ->withParent($child->id)
                    ->create();
                
            }
        }
    }
}