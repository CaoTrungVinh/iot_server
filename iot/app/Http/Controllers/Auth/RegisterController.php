<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Notifications\ActiveAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegister() {
        return view( 'auth.register');
    }

    public function doRegister(Request $request){
        $request->validate([
            'r_userName' => 'required|min:3|max:50',
            'r_email'     => 'required|email',
            'r_pass'      => 'required|min:8',
            'r_repass'    => 'required|same:r_pass',
        ], $this->messages());
        $user = User::where( 'email', '=', $request->r_email )->first();
        // email không tồn tại gửi email mơi
        if ( $user == null ) {
            $token = Str::random( 40 );
            $user  = User::create( [
                'email'      => $request->r_email,
                'password'   => Hash::make( $request->input( 'r_pass' ) ),
                'name' => $request->r_userName,
                'random_key' => $token,
                'key_time'   => Carbon::now()->addHour( 12 )->format( 'Y-m-d H:i:s' )
            ] );

            $user->notify( new ActiveAccount() );

            return redirect( 'login' )->with( 'ok', 'Bạn đăng ký thành công vui lòng check Email để kích hoạt tài khoản' );
        } else {
            // đã tồn tại active 1 thông báo lỗi
            if ($user->active == 1) {
                return redirect()->back()->withErrors(['r_email' => 'Email đã tồn tại!']);
            } else {
                // email tồn tại active =0 gửi lại email
                $token = Str::random(40);
                $user->random_key = $token;
                $user->key_time = Carbon::now()->addHour(12)->format('Y-m-d H:i:s');
                $user->update();
                $user->notify(new ActiveAccount());

                return redirect('login')->with('ok', 'Bạn đăng ký thành công vui lòng check Email để kích hoạt tài khoản');
            }
        }
    }

    public function register() {
        Session::put( 'signup', true );

        return redirect( 'login' );
    }

    public function confirmEmail( $email, $key ) {
        //		Session::forget( 'signup' );

        $u = User::select( 'id', 'email', 'key_time', 'active' )
            ->where( 'email', '=', $email )
            ->where( 'random_key', $key )
            ->where( 'active', '=', '0' )
            ->first();

        if ( $u == null ) {
            dd($u);
            return redirect( 'login' )->withErrors( [ 'mes' => 'Xác nhận email không thành công! Email hoặc mã xác thực không đúng. ' ] );
        } else {
            $kt  = Carbon::parse( $u->key_time );
            $now = Carbon::now();
            if ( $now->lt( $kt ) == true ) {
                $u->active     = 1;
                $u->key_time   = null;
                $u->random_key = null;
                $u->update();
                $role = Role::find(1);
                $u ->update(['role_id' => $role->id]);

                return redirect( 'login' )->with( 'ok', 'Xác nhận email thành công! Bạn có thể đăng nhập.' );
            } else {
                return redirect( 'login' )->withErrors( [ 'mes' => 'Liên kết đã hết hạn!' ] );
            }
        }
    }

    private function messages() {
        return [
            'r_firstname.required' => 'Bạn cần nhập họ tên',
            'r_firstname.min'      => 'Họ tên cần lớn hơn 3 kí tự',
            'r_firstname.max'      => 'Họ tên cần bé hơn 50 kí tự',
            'r_lastname.required'  => 'Bạn cần nhập họ tên',
            'r_lastname.min'       => 'Họ tên cần lớn hơn 3 kí tự',
            'r_lastname.max'       => 'Họ tên cần bé hơn 50 kí tự',
            'r_email.required'     => 'Bạn cần phải nhập Email.',
            'r_email.email'        => 'Định dạng Email bị sai.',
            'r_email.unique'       => 'Email đã tồn tại',
            'r_pass.required'      => 'Bạn cần phải nhập Password.',
            'r_pass.min'           => 'Password phải nhiều hơn 8 ký tự.',
            'r_repass.same'        => 'RePassword không trùng với password',
            'r_pass.required'      => 'Bạn cần nhập Repassword',
        ];
    }
}
