<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/2/2021
 * Time: 4:28 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pond extends Model
{
    use HasFactory;

    protected $table = "ponds";

    protected $fillable = ['id', 'id_user', 'name', 'address'];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public $timestamps = false;
}