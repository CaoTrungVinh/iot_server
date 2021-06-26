<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'id',
        'email',
        'password',
        'name',
        'random_key',
        'role_id',
        'key_time',
        'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public function role() {
        return $this->belongsTo( Role::class);
    }

//    public function posts() {
//        return $this->hasMany('App\Models\Posts');
//    }

    public function routeNotificationForFcm()
    {
        return ['ewNf0t3USXOEIPN0muewVZ:APA91bGQAI5P2Vjy1NQ28aqoJ8qMqxMOlyQ3xMv73LrvcfNlG_PuMEZWkABtX7XKvrqT8RLaMYOiGWVU0yVZu3XotA9e8OUuwWuvIxX9nH7pm_2POOX-aacR8D_LRrpfvceFpj2iZVQE'];
    }
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
