<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/23/2021
 * Time: 7:21 PM
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Token_FCM extends Model
{
    use HasFactory;

    protected $table = "fcm";

    protected $fillable = ['id','id_user','token_fcm'];

    public $timestamps = false;

}