<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warning_Temp extends Model
{
    use HasFactory;

    protected $table = "warning_temperature";
    protected $fillable = ['temperature_min', 'temperature_max', 'warning_id'];
    public $timestamps = false;
}