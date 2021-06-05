<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DHT11 extends Model
{
    use HasFactory;

    protected $table = "dht11s";
    protected $fillable = ['humi','temp'];

    public $timestamps = false;
}
