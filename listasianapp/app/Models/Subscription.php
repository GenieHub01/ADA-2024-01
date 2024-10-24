<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'advert_id', 
        'plan_id', 
        'stripe_subscription_id',
    ];

    public function advert()
    {
        return $this->belongsTo(Advert::class, 'advert_id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public static function rules()
    {
        return [
            'advert_id' => 'required|integer',
            'plan_id' => 'required|integer',
            'stripe_subscription_id' => 'nullable|string|max:255',
        ];
    }

    public static function search($params)
    {
        $query = self::query();

        if (isset($params['advert_id'])) {
            $query->where('advert_id', $params['advert_id']);
        }

        if (isset($params['plan_id'])) {
            $query->where('plan_id', $params['plan_id']);
        }

        if (isset($params['stripe_subscription_id'])) {
            $query->where('stripe_subscription_id', 'like', '%' . $params['stripe_subscription_id'] . '%');
        }

        return $query->get();
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'advert_id' => 'Advert',
            'plan_id' => 'Plan',
            'stripe_subscription_id' => 'Stripe Subscription',
        ];
    }
}
