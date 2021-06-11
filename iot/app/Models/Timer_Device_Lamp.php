<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Timer_Device_Lamp extends Model
{
    use HasFactory;

    protected $table = "timer_device_lamp";

    protected $fillable = ['id_lamp', 'timer_on','timer_off'];

    public $timestamps = false;
}