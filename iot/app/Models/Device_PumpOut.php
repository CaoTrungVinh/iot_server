<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/7/2021
 * Time: 11:31 AM
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device_PumpOut extends Model
{
    use HasFactory;

    protected $table = "device_pump_out";

    protected $fillable = ['control', 'description','created_at'];

    public $timestamps = false;
}