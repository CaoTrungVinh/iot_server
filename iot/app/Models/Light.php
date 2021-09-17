<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Light extends Model
{
    use HasFactory;

    protected $table = "lights";
    protected $fillable = ['light','description','warning', 'auto_control', 'created_at'];

    public function toolkits()
    {
        return $this->belongsTo(Toolkit::class, 'id_light', 'id');
    }

    public $timestamps = false;
}
