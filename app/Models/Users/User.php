<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const NAME = 'name';
    const USER_NAME = 'user_name';
    const PHONE = 'phone';
    const EMAIL = 'email';
    const IMAGE = 'image';
    const GOOGLE_ID = 'google_id';
    const FACEBOOK_ID = 'facebook_id';
    const PASSWORD = 'password';
    const RE_PASSWORD = 're_password';
    const STATUS = 'status';
    const LEVEL = 'level';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        self::NAME,
        self::USER_NAME,
        self::EMAIL,
        self::IMAGE,
        self::GOOGLE_ID,
        self::FACEBOOK_ID,
        self::PASSWORD,
        self::RE_PASSWORD,
        self::STATUS,
        self::LEVEL
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        self::PASSWORD, self::RE_PASSWORD, 'remember_token',
    ];

    public static function getFieldVietnamese() {
        return [
            self::EMAIL    => trans('field.email'),
            self::PASSWORD => trans('field.password'),
        ];
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
