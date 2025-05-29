<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use SoftDeletes; // Для мягкого удаления
    use HasFactory;
    
    protected $fillable = [
        'name',
        'phone',
        'building',
        'activity',
        'building_id', 
        'activity_id'
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
    
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}