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

    protected $fillable = ['name','address'];

    public $timestamps = false;
}