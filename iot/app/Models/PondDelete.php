<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PondDelete extends Model
{
    use HasFactory;

    protected $table = "ponds_delete";

    protected $fillable = ['id', 'id_user', 'name', 'address', 're_countToolkit', 're_countControl', 'active', 'delete_date'];
}
