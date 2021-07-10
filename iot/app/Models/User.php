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
        'gender',
        'birthday',
        'phone',
        'address',
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

    public function ponds() {
        return $this->hasMany('App\Models\Pond');
    }

    public function routeNotificationForFcm()
    {
        return ['c63zyjhoQLSmarRcfwLP4E:APA91bEe7Nju2xX9ZXSKMa1z_EznyDBiKvSk450kTqpDSxe9J0QG7ZpT121y8V9YbadYNn91x1oJCmsNkLmOKTU8c5K8QbwLEYNkcByejLkfWzbg6yXvGkPPH4C9AlGBoidgSSTLBgJc'];
    }
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
