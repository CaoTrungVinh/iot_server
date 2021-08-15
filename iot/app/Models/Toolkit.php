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

    protected $fillable = ['id','id_pond','id_temperature','id_ph','id_light', 'name','address', 'active', 'create_date', 'update_date', 'delete_date', 'key_active', 'dateLap'];

    public function ponds()
    {
        return $this->belongsTo(Pond::class, 'id');
    }

    public function phs()
    {
        return $this->hasOne(PH::class, 'id', 'id_ph');
    }

    public function temperatures()
    {
        return $this->hasOne(Temperature::class, 'id', 'id_temperature');
    }

    public function lights()
    {
        return $this->hasOne(Light::class, 'id','id_light');
    }

    public $timestamps = false;
}
