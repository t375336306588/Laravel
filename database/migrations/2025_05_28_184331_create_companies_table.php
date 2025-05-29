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
        Schema::create('companies', function (Blueprint $table) {
            $table->id(); // Первичный ключ (автоинкремент)
            $table->string('name')->comment('Название компании'); // Название
            $table->string('phone', 20)->nullable()->comment('Номер телефона'); // Номер телефона
            $table->string('building')->comment('Здание/Адрес'); // Здание
            $table->text('activity')->comment('Деятельность'); // Деятельность
            
            // Таймстампы для created_at и updated_at
            $table->timestamps(); 
            
            $table->softDeletes(); // Для мягкого удаления
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
