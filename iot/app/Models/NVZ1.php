<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class NVZ1 extends Model
{
    use HasFactory;

    protected $table = "nvz1s";
    protected $fillable = ['light','description','created_at','updated_at'];

    public $timestamps = false;
}