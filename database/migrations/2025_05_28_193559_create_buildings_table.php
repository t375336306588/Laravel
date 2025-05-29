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
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            
            // Основные данные
            $table->string('name')->comment('Название здания');
            
            // Адресные данные
            $table->string('address_line1', 255)->comment('Основной адрес');
            $table->string('address_line2', 255)->nullable()->comment('Дополнительная адресная информация');
            $table->string('city', 100)->comment('Город');
            $table->string('district', 100)->nullable()->comment('Район');
            $table->string('postal_code', 20)->comment('Почтовый индекс');
            $table->string('country', 50)->default('Россия')->comment('Страна');
            
            // Географические координаты
            $table->decimal('latitude', 10, 8)->comment('Широта');
            $table->decimal('longitude', 11, 8)->comment('Долгота');
            
            
            // Индексы
            $table->index('name');
            $table->index('city');
            $table->index(['latitude', 'longitude']);
            
            // Таймстампы
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buildings');
    }
};
