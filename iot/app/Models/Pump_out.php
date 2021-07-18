<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/5/2021
 * Time: 12:20 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Pump_out extends Model
{
    use HasFactory;

    protected $table = "pump_out";

    protected $fillable = ['status','timer_on','timer_off'];

    public function controls()
    {
        return $this->belongsTo(Control::class, 'id_pump_out', 'id');
    }

    public $timestamps = false;
}
