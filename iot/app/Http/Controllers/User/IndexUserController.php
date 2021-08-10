<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexUserController extends Controller
{
    public function indexUser()
    {
        $pondUser = Pond::withCount('tollkits')->withCount('controls')
            ->where('id_user', '=', session('UserID'))->get();
//        $pondUser = Pond::where('id_user', '=', session('UserID'))->get();
       return view('pages.homeUser', ['pondUser'=>$pondUser]);
    }
}
