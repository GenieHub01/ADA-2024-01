<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubRegion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function adverts(): HasMany
    {
        return $this->hasMany(Advert::class, 'sub_region_id');
    }

    public function packagePrices(): HasMany
    {
        return $this->hasMany(PackagePrice::class, 'sub_region_id');
    }

    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    public static function search($query)
    {
        return self::query()
            ->where('name', 'like', '%' . $query . '%')
            ->get();
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
}
