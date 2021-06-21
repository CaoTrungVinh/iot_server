<?php


namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Session;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
//    public function handle( $request, Closure $next ) {
//        // Check admin permission group
//        if ( ! in_array( 2, Session::get( 'group' ) ) ) {
//            return redirect()->back()->withErrors( [ 'mes' => 'Bạn không có quyền' ] );
//        } else {
//            return $next( $request );
//        }
//    }

    public function handle($request, Closure $next)
    {
        if(session('AdminID')) {
//            if(session('EditorID') && !request()->ajax())
//                return redirect()->route('adminLogin');
            return $next($request);
        }

        else
//            return redirect()->route('adminLogin');
            return redirect()->back()->withErrors( [ 'mes' => 'Bạn không có quyền' ] );
    }
}
