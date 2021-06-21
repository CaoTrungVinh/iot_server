<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Timer_Device_Oxygen_Fan extends Model
{
    use HasFactory;

    protected $table = "timer_device_oxygen_fan";

    protected $fillable = ['id_oxygen_fan', 'timer_on','timer_off'];

    public $timestamps = false;
}