<?php

namespace App\Models;

use Carbon\Carbon;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject{
    use HasFactory, Notifiable;

    protected $hidden = [
        'password',
        'username',
        'remember_token',
    ];

    protected function casts(): array{
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function scopeByAdmin($query){
        return $query->where("type_id", 1);
    }

    public function scopeCreatedToday($query){
        return $query->whereDate('created_at', Carbon::today());
    }


}
