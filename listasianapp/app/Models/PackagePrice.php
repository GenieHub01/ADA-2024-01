<?php

namespace App\Models;

use App\Services\GeoService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackagePrice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'country_id',
        'region_id',
        'sub_region_id',
        'country_name',
        'region_name',
        'price_1',
        'price_2',
        'price_3'
    ];

    const PACKAGE_SILVER = 1;
    const PACKAGE_GOLD = 2;
    const PACKAGE_PLATINUM = 3;

    public function subRegions(): BelongsTo
    {
        return $this->belongsTo(SubRegion::class, 'sub_region_id');
    }

    protected static function booted()
    {
        static::saving(function ($model) {
            $model->country_name = GeoService::getCountryName($model->country_id) ?? 'Unknown Country';
            $model->region_name = GeoService::getRegionName($model->country_id, $model->region_id) ?? 'Unknown Region';
        });
    }
}
