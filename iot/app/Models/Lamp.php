<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/5/2021
 * Time: 12:21 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Lamp extends Model
{
    use HasFactory;

    protected $table = "lamp";

    protected $fillable = ['status','timer_on','timer_off'];

    public function controls()
    {
        return $this->belongsTo(Control::class, 'id_lamp', 'id');
    }

    public $timestamps = false;
}
