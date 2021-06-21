<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Device_Lamp extends Model
{
    use HasFactory;

    protected $table = "device_lamp";

    protected $fillable = ['control', 'description','created_at'];

    public $timestamps = false;
}