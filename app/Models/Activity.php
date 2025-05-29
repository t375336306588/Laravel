<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'depth',
    ];

    /**
     * Родительская категория
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Дочерние категории
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }
    
    public function companies()
    {
        return $this->hasMany(Company::class);
    }
    
}