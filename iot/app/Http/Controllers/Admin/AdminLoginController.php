<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    public function showLogin()
    {
        if (session('AdminID')) {
            return redirect()->route('home');
        } else
            return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'pass' => 'required|min:8',
        ], $this->messages());
//        check email đã active hay chưa &  check tài khoản admin với role_id = 2
        $u = User::where('email', '=', $request->email)
            ->where('role_id', '=', '2')
            ->where('active', '=', '1')->first();
        if (!$u) {
            return redirect()->back()->withInput($request->only('email'))->withErrors(['mes' => 'email chưa được đăng ký hoặc không có quyền đăng nhập!']);
        } else {
            if ( Hash::check($request->pass, $u->password)) {
                Session::put('AdminID', $u->id);
                Session::put('Auth', $u);
                 return redirect()->route('home');
            } else {
                return redirect()->back()->withInput($request->only('pass'))->withErrors(['mes' => 'Bạn đã nhập sai Password!']);
            }
        }

    }

    public function getLogout(Request $request)
    {
        Session::forget('AdminID');
        Session::forget('Auth');
        return redirect()->route('adLogin');
    }

    private function messages()
    {
        return [
            'email.required' => 'Bạn cần phải nhập Email.',
            'email.email' => 'Email sai định dạng.',
            'pass.required' => 'Bạn cần phải nhập Password.',
            'pass.min' => 'Password phải nhiều hơn 8 ký tự.',
        ];
    }
}
