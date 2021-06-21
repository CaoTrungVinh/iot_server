<?php


namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Session;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
//    public function handle( $request, Closure $next ) {
//        if ( ! $request->session()->exists( 'auth' ) ) {
//            // user value cannot be found in session
//            Session::put('url',$request->fullUrl());
//            return redirect( 'login' )->withErrors( [ 'mes' => "Bạn chưa đăng nhập." ] );
//        }
//
//        return $next( $request );
//    }

    public function handle($request, Closure $next)
    {
        if(session('Email'))
            return $next($request);
        else
//            return redirect()->route('login');
            return redirect( 'login' )->withErrors( [ 'mes' => "Bạn chưa đăng nhập." ] );
    }
}
