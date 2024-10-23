<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'description'
    ];

    public static $rules = [
        'description' => 'max:255',
        'value' => 'numeric',
    ];

    public function adverts(): HasMany
    {
        return $this->hasMany(Advert::class, 'package');
    }
}
