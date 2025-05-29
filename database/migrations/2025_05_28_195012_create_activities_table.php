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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            
            // Название вида деятельности
            $table->string('name')->unique()->comment('Название вида деятельности');
            
            // Поля для древовидной структуры
            $table->unsignedBigInteger('parent_id')->nullable()->comment('Родительская категория');
            $table->integer('depth')->default(0)->comment('Глубина вложенности');
            
            // Индексы
            $table->index('parent_id');
            $table->index('depth');
            
            // Внешний ключ для древовидной структуры
            $table->foreign('parent_id')
                ->references('id')
                ->on('activities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            // Таймстампы
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
        });
        
        Schema::dropIfExists('activities');
    }
};