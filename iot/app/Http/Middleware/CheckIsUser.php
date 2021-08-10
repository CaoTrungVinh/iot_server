<?php


namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Session;

class CheckIsUser
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
//        //kieemr tra quyen cuar user is doanhnghiep
//        if ( ! in_array( 1, Session::get( 'group' ) ) ) {
//            return redirect()->back()->withErrors( [ 'mes' => 'Bạn không có quyền' ] );
//        } else {
//            return $next( $request );
//        }
//
//    }

    public function handle($request, Closure $next)
    {
        if(session('UserID')) {
            return $next($request);
        } else
            return redirect()->route('userLogin');
    }
}
