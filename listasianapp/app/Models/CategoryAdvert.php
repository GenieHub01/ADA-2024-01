<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryAdvert extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'advert_id'
    ];

    public function advert(): BelongsTo
    {
        return $this->belongsTo(Advert::class, 'advert_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
