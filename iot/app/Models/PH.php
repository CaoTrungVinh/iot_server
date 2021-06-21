<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PH extends Model
{
    use HasFactory;

    protected $table = "phs";
    protected $fillable = ['id_warning','value','created_at','updated_at'];

    public $timestamps = false;
}