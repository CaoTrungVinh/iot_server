<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/4/2021
 * Time: 7:58 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Control extends Model
{
    use HasFactory;

    protected $table = "control";

    protected $fillable = ['name','address','id_pond','id_pump_in','id_pump_out','id_lamp','id_oxygen_fan'];

    public $timestamps = false;
}