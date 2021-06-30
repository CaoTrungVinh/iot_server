<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function showForgotPass(){
        return view('auth.forgot');
    }

    public function doForgotPass(){

    }

}
