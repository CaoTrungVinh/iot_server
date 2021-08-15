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

    protected $fillable = ['id', 'id_user', 'name', 'address', 're_countToolkit', 're_countControl', 'active', 'singup_date', 'created_date', 'update_date', 'delete_date'];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function toolkits()
    {
        return $this->hasMany(Toolkit::class, 'id_pond');
    }

    public function controls()
    {
        return $this->hasMany(Control::class, 'id_pond');
    }

    public $timestamps = false;
}
