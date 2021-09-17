<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PH extends Model
{
    use HasFactory;

    protected $table = "phs";
    protected $fillable = ['id','value','ph_min','ph_max','warning', 'auto_control', 'created_at'];

    public function toolkits()
    {
        return $this->belongsTo(Toolkit::class, 'id_ph', 'id');
    }

    public $timestamps = false;

}
