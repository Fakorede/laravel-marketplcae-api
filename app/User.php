<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';
    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    protected $dates = ['deleted_at'];

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verified', 'verification_token', 'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
        // 'verification_token',
    ];

    /**
     * Mutators
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtolower($name);
    }

    public function setEmailAttributes($email)
    {
        $this->attributes['email'] = strtolower($email);
    }

    /**
     * Accessors
     */
    public function getNameAttribute($name)
    {
        return ucwords($name);
    }

    /**
     * Methods
     */
    public function isVerified()
    {
        return $this->verified === User::VERIFIED_USER;
    }

    public function isAdmin()
    {
        return $this->admin === User::ADMIN_USER;
    }

    public static function generateVerificationCode()
    {
        return str_random(40);
    }
}
