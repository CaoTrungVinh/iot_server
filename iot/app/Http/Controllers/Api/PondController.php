<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/2/2021
 * Time: 4:42 PM
 */

namespace App\Http\Controllers\Api;
use App\Models\Pond;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class PondController extends Controller
{
    public function pond(Request $request){
        $pond = Pond::all()->where('id_user', '=', $request->get("user"));
        return \response()->json($pond, 200);
    }
}