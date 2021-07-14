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

    protected $table = "toolkits";

    protected $fillable = ['id','id_pond','id_temperature','id_ph','id_light', 'name','address'];

    public $timestamps = false;
}