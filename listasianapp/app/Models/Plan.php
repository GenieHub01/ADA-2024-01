<?php

namespace App\Models;

use App\Exceptions\StripePlanException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'stripe_id',
        'name',
        'package',
        'interval',
        'amount',
        'currency',
    ];

    public $intervalList = [
        3 => 'day',
        1 => 'month',
        2 => 'year',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'plan_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($plan) {
            if (!isset($plan->intervalList[$plan->interval])) {
                throw new \Exception('Wrong interval');
            }

            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

            try {
                $stripePlan = \Stripe\Plan::create([
                    'amount'   => $plan->amount * 100,
                    'interval' => $plan->intervalList[$plan->interval],
                    'product'  => [
                        'name' => $plan->name,
                    ],
                    'currency' => $plan->currency,
                    'id'       => $plan->stripe_id,
                ]);

                $plan->stripe_id = $stripePlan->id;

            } catch (\Exception $e) {
                throw new StripePlanException('Stripe Plan Creation Failed: ' . $e->getMessage());
            }
        });
    
        static::deleting(function ($plan) {
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

            try {
                $stripePlan = \Stripe\Plan::retrieve($plan->stripe_id);
                $stripePlan->delete();

            } catch (\Exception $e) {
                throw new StripePlanException('Stripe Plan Deletion Failed: ' . $e->getMessage());
            }
        });
    }
}