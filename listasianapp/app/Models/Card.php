<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'card';

    protected $fillable = [
        'user_id',
        'card_hash',
        'stripe_customer_id',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function rules()
    {
        return [
            'user_id' => 'required|integer',
            'card_hash' => 'required|string|max:255',
            'stripe_customer_id' => 'required|string|max:255',
        ];
    }

    public static function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'card_hash' => 'Card Hash',
            'stripe_customer_id' => 'Stripe Customer ID',
        ];
    }

    public function search($query)
    {
        return $this->where('id', $query->id)
                    ->get();
    }
}
