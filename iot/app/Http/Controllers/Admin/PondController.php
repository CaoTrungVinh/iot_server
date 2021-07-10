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
use Illuminate\Http\Request;
class PondController extends Controller
{
    public function index(){
        $data = Pond::all();
        return view('ponds.index');
    }
}