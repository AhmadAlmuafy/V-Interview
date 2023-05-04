<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Company extends Authenticatable implements JWTSubject {
    use HasFactory, Notifiable;

    protected $table = "company";

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'location',
        'phone',
        'industry',
        'website',
        'founded',
        'photo',
        'description',
        'active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    public $timestamps = false;

}
