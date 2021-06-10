<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temperature extends Model
{
    use HasFactory;

    protected $table = "temperatures";

    protected $fillable = ['temperature','created_at','updated_at'];

    public $timestamps = false;
}