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
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
//        dd('helo');
//        session_start();
        $request->validate( [
            'email' => 'required|email',
            'pass'  => 'required|min:8',
        ], $this->messages() );

//        check email đã active hay chưa
        $users = User::select('email')
            ->where( 'email', '=', $request->email )
            ->where( 'active', '=', '1' )
            ->get();
        if ( count( $users ) == 1 ) {
//            check tài khoản admin với role_id = 2
            $u = User::where( 'email', '=', $request->email)
                ->where( 'role_id', '=', '2' )
                ->where( 'active', '=', '1' )->first();
            if (($u->email == $request->email) && Hash::check($request->pass, $u->password)) {
                Session::put('AdminID', $u->id);
                Session::put('AdminEmail', $u->email);
                return redirect('home');
            } else {
                return redirect()->back()->withInput($request->only('email'))->withErrors(['mes' => 'Bạn đã nhập sai Email hoặc Password!']);
            }
        }
        return redirect()->back()->withInput($request->only('email'))->withErrors(['mes' => 'email chưa được đăng ký!']);
//        $users = User::select( 'id', 'email', 'password' )
//            ->where( 'email', '=', $request->get( 'email' ) )
//            ->where( 'active', '=', '1' )
//            ->get();
//
//        if ( count( $users ) == 1 ) {
//            $u = $users[0];
//            if ( $u->email == $request->get( 'email' ) && Hash::check( $request->get( 'pass' ), $u->password ) ) {
//                $u     = User::select( 'id', 'email', 'name' )
//                    ->where( 'id', '=', $u->id )
//                    ->where( 'active', '=', '1' )->first();
//                $group = $u->groups;
//                $arrid = [];
//                foreach ( $group as $g ) {
//                    array_push( $arrid, $g->id );
//                }
//                Session::put( 'auth', $u );
//                Session::put( 'group', $arrid );
////                Session::put( 'id', $u->id );
//                $_SESSION['host']  = env( 'APP_URL' );
//                $_SESSION['email'] = $u->email;
//                $_SESSION['auth']  = true;
//                $url               = Session::get( 'url' );
//                if ( empty( $url ) ) {
//                    if(in_array(2,$arrid)) return  redirect('home');
//                    return redirect( '/' );
//                } else {
//                    Session::forget( 'url' );
//
//                    return redirect( $url );
//                }
////                return redirect('home');
//            } else {
//                return redirect()->back()
//                    ->withInput( $request->only( 'email' ) )
//                    ->withErrors( [ 'mes' => 'Bạn đã nhập sai Email hoặc Password' ] );
//            }
//        } else {
//            return redirect()->back()->withInput( $request->only( 'email' ) )->withErrors( [ 'mes' => 'Bạn đã nhập sai Email hoặc Password!' ] );
//        }
    }

    public function getLogout(Request $request)
    {
        Session::forget( 'AdminID' );
        Session::forget( 'AdminEmail' );
        return redirect('login');
    }

    private function messages() {
        return [
            'email.required' => 'Bạn cần phải nhập Email.',
            'email.email'    => 'Email sai định dạng.',
            'pass.required'  => 'Bạn cần phải nhập Password.',
            'pass.min'       => 'Password phải nhiều hơn 8 ký tự.',
        ];
    }
}
