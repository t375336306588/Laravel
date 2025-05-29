<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Building extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name',
        'address_line1',
        'address_line2',
        'city',
        'district',
        'postal_code',
        'country',
        'latitude',
        'longitude',
    ];
    
    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public function companies()
    {
        return $this->hasMany(Company::class);
    }
}