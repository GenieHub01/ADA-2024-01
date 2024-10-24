<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Paylog extends Model
{
    use HasFactory;

    protected $table = 'paylog';

    protected $fillable = [
        'transaction_id',
        'user_id',
        'advert_id',
        'amount',
        'description',
        'create_time',
        'token',
        'active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('active', 1);
    }

    public function getPayments($userId)
    {
        return $this->where('user_id', $userId)
                    ->active()
                    ->orderBy('id', 'DESC')
                    ->paginate(config('app.page_size'));
    }
}
