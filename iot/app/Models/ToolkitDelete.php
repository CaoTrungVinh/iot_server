<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolkitDelete extends Model
{
    use HasFactory;

    protected $table = "toolkits_delete";

    protected $fillable = ['id','id_pond','id_temperature','id_ph','id_light', 'name','address', 'delete_date', 'key_active', 'date_active'];
}
