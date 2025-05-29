<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // Добавляем building_id как внешний ключ
            $table->foreignId('building_id')
                ->nullable() // Может быть null (если организация не привязана к зданию)
                ->after('id') // Размещаем после id (опционально)
                ->constrained('buildings') // Связь с таблицей buildings
                ->onDelete('set null'); // При удалении здания - set null

            // Добавляем activity_id как внешний ключ
            $table->foreignId('activity_id')
                ->nullable()
                ->after('building_id')
                ->constrained('activities')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // Удаляем связи и столбцы при откате миграции
            $table->dropForeign(['building_id']);
            $table->dropForeign(['activity_id']);
            
            $table->dropColumn('building_id');
            $table->dropColumn('activity_id');
        });
    }
};
