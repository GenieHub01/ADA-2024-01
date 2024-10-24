<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'notes',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;

    public static function rules($isNew = false)
    {
        $rules = [
            'email' => 'required|email|unique:User,email',
            'name' => 'required|max:200',
            'phone' => 'nullable|max:200',
            'password' => ($isNew ? 'required' : 'nullable') . '|min:5|confirmed',
            'expiry' => 'nullable|date',
            'discount' => 'integer|min:0|max:100',
        ];

        if (Auth::guest()) {
            $rules['recaptcha'] = 'required|captcha';
        }

        return $rules;
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->role = self::ROLE_USER;
            $user->expiry = Carbon::now()->addYear();
        });

        static::updating(function ($user) {
            if ($user->isDirty('password') && !empty($user->password)) {
                $user->hash = Hash::make($user->password);
            }
            if (!empty($user->expiry)) {
                $user->expiry = Carbon::parse($user->expiry);
            }
        });
    }

    public function newPassword($email)
    {
        $user = self::where('email', $email)->first();

        if (!$user) return;

        $password = substr(md5(uniqid()), 0, 6);
        $user->password = $password;
        $user->hash = Hash::make($password);
        $user->save();

        Mail::send('emails.newPassword', ['password' => $password], function ($message) use ($user) {
            $message->to($user->email)->subject('New Password');
        });
    }

    public function getNameAttribute()
    {
        return $this->f_name . ' ' . $this->l_name;
    }

    public function socialLogin($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            $email = $socialUser->getEmail() ?? 'fb_' . $socialUser->getId();
            
            $user = self::firstOrCreate(
                ['email' => $email],
                ['password' => Hash::make($email)]
            );

            Auth::login($user);
        } catch (\Exception $e) {
        }
    }

    public function getList()
    {
        return self::all()->pluck('email', 'id');
    }
}
