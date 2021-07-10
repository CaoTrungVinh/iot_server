<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/10/2021
 * Time: 10:32 AM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pond;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PondController extends Controller
{
    public function index()
    {
        $ponds = DB::select('SELECT ponds.`name`, ponds.address, users.`name` as name_user
          FROM ponds, users
          WHERE ponds.id_user=users.id');
        return view('ponds.index', compact('ponds'));
    }
}