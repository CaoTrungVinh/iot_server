<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Time_Device_PumpOut extends Model
{
    use HasFactory;

    protected $table = "timer_device_pump_out";

    protected $fillable = ['id_pump_out', 'timer_on','timer_off'];

    public $timestamps = false;
}