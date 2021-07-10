<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/2/2021
 * Time: 4:28 PM
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pond extends Model
{
    use HasFactory;

    protected $table = "ponds";

    protected $fillable = ['id_user','name','address'];

    public function users() {
        return $this->belongsTo(User::class);
    }

    public $timestamps = false;
}