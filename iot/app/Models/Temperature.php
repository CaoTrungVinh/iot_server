<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temperature extends Model
{
    use HasFactory;

    protected $table = "temperatures";

    protected $fillable = ['temperature','temperature_min','temperature_max','warning','created_at'];

    public $timestamps = false;
}