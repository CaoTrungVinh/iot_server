<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PH extends Model
{
    use HasFactory;

    protected $table = "phs";
    protected $fillable = ['value','ph_min','ph_max','warning','created_at'];

    public $timestamps = false;

}