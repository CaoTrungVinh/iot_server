<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileAdminController extends Controller
{
    public function showProfile(){
        return view('pages.profile');
    }
}
