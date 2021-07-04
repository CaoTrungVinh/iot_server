<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/2/2021
 * Time: 4:53 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Toolkit extends Model
{
    use HasFactory;

    protected $table = "temperatures";

    protected $fillable = ['id_temperature','id_ph','id_light'];

    public $timestamps = false;
}