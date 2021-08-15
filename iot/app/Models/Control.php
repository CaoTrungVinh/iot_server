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

    protected $fillable = ['name','address','id_pond','id_pump_in','id_pump_out','id_lamp','id_oxygen_fan', 'active', 'create_date', 'update_date', 'delete_date', 'key_active', 'date_active'];

    public function ponds()
    {
        return $this->belongsTo(Pond::class, 'id');
    }

    public function pumpIns()
    {
        return $this->hasOne(Pump_In::class, 'id', 'id_pump_in');
    }

    public function pumpOut()
    {
        return $this->hasOne(Pump_out::class, 'id', 'id_pump_out');
    }

    public function lamps()
    {
        return $this->hasOne(Lamp::class, 'id','id_lamp');
    }

    public function oxygen()
    {
        return $this->hasOne(Oxygen_fan::class, 'id','id_oxygen_fan');
    }


    public $timestamps = false;
}
