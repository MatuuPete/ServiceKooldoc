<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\SuperAdmin;
use App\Models\Technician;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use HasFactory, Notifiable;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'phone_number', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function superAdmin()
    {
        return $this->hasOne(SuperAdmin::class);
    }

    public function technician()
    {
        return $this->hasOne(Technician::class);
    }

    public function sendPasswordResetNotification($t)
    {
        $token = $t;

        $this->notify(new ResetPasswordNotification($token));
    }
}
