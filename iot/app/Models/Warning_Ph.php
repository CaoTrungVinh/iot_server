<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/5/2021
 * Time: 2:18 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warning_Ph extends Model
{
    use HasFactory;

    protected $table = "warning_ph";
    protected $fillable = ['ph_min', 'ph_max'];
    public $timestamps = false;
}