<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temperature extends Model
{
    use HasFactory;

    protected $table = "temperatures";

    protected $fillable = ['id','temperature','temperature_min','temperature_max','warning','auto_control','created_at'];

    public function toolkits()
    {
        return $this->belongsTo(Toolkit::class, 'id_temperature', 'id');
    }

    public $timestamps = false;
}
