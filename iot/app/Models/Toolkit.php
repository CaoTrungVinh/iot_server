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

    protected $fillable = ['name','address'];

    public $timestamps = false;
}