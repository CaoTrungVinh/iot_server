<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DS18B20 extends Model
{
    use HasFactory;

    protected $table = "ds18b20s";

    protected $fillable = ['temperature'];

    public $timestamps = false;
}