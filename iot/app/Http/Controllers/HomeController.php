<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $u_id = session('AdminID');
        return view('pages.home')->with(['u_id' => $u_id]);
    }
}
