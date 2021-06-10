<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device_Oxygen_fan extends Model
{
    use HasFactory;

    protected $table = "device_oxygen_fan";

    protected $fillable = ['control', 'description','created_at'];

    public $timestamps = false;
}