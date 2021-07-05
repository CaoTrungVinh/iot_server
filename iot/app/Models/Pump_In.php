<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/5/2021
 * Time: 11:56 AM
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Pump_In extends Model
{
    use HasFactory;

    protected $table = "pump_in";

    protected $fillable = ['status','timer_on','timer_off'];

    public $timestamps = false;
}