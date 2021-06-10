<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device_PumpIn extends Model
{
    use HasFactory;

    protected $table = "device_pump_in";

    protected $fillable = ['control', 'description','created_at'];

    public $timestamps = false;
}