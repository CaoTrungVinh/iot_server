<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Control;
use App\Models\Pond;
use App\Models\Toolkit;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $count_Account = User::all()->count();
        $count_User = User::where('role_id', '=', 1)->count();
        $count_Active = User::where('active', '=', 1)->count();
        $count_Pond = Pond::all()->count();
        $count_Toolkit = Toolkit::all()->count();
        $count_Control = Control::all()->count();
        $getAdmin = User::where('role_id', '=', 2)->get();
        return view('pages.home')->with([
            /*Account*/
            'count_Account' => $count_Account,
            'count_User' => $count_User,
            'count_Active' => $count_Active,
            /*Pond-toolkit-control*/
            'count_Pond' => $count_Pond,
            'count_Toolkit' => $count_Toolkit,
            'count_Control' => $count_Control,
            /*lấy danh sách admin*/
            'getAdmin' => $getAdmin,
        ]);
    }
}
