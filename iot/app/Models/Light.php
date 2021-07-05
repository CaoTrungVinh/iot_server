<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Light extends Model
{
    use HasFactory;

    protected $table = "lights";
    protected $fillable = ['light','description','warning','created_at'];

    public $timestamps = false;
}