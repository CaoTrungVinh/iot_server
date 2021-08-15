<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlDelete extends Model
{
    use HasFactory;

    protected $table = "control_delete";

    protected $fillable = ['id', 'name', 'address', 'id_pond', 'id_pump_in', 'id_pump_out', 'id_lamp', 'id_oxygen_fan', 'delete_date', 'key_active', 'date_active'];
}
