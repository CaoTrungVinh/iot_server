<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ActiveAccountRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegister() {
        return view( 'auth.register');
    }

    public function doRegister(Request $request){
        $request->validate([
            'r_email' => 'required|email',
            'r_userName' => 'required|min:3|max:50',
            'r_pass' => 'required|min:8',
            're_pass' => 'required|same:r_pass',
            'r_birthday' => 'required|min:4|max:10',
            'r_gender' => 'required|max:20',
            'r_phone' => 'required|min:10|max:11',
            'r_address' => 'required',
        ], $this->messages());
        $user = User::where( 'email', '=', $request->r_email )->first();
        // email không tồn tại gửi email mơi
        if ( $user == null ) {
            $token = Str::random( 40 );
            $user  = User::create( [
                'email'      => $request->r_email,
                'password'   => Hash::make($request->r_pass),
                'name' => $request->r_userName,
                'birthday' => $request->r_birthday,
                'gender' => $request->r_gender,
                'phone' => $request->r_phone,
                'address' => $request->r_address,
                'random_key' => $token,
                'role_id' => 1,
                'key_time'   => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s')
            ] );

            $user->notify( new ActiveAccountRegister());

            return redirect()->back()->withInput($request->only('ok'))->withErrors(['register' => 'Tạo tài khoản thành công - kiểm tra email để kích hoạt tài khoản.']);
        } else {
            // đã tồn tại active 1 thông báo lỗi
            if ($user->active == 1) {
                return redirect()->back()->withErrors(['r_email' => 'Email này đã được đăng ký tài khoản khác!']);
            } else {
                // email tồn tại active =0 gửi lại email
                $token = Str::random(40);
                $user->email = $request->r_email;
                $user->password = Hash::make($request->r_pass);
                $user->name = $request->r_userName;
                $user->birthday = $request->r_birthday;
                $user->gender = $request->r_gender;
                $user->phone = $request->r_phone;
                $user->address = $request->r_address;
                $user->role_id = 1;
                $user->random_key = $token;
                $user->key_time = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
                $user->update();
                $user->notify(new ActiveAccountRegister());

                return redirect()->back()->withInput($request->only('ok'))->withErrors(['register' => 'Tạo tài khoản thành công - kiểm tra email để kích hoạt tài khoản.']);
            }
        }
    }

    public function confirmEmail( $email, $key ) {
        //		Session::forget( 'signup' );

        $u = User::select( 'id', 'email', 'key_time', 'active' )
            ->where( 'email', '=', $email )
            ->where( 'random_key', $key )
            ->where( 'active', '=', '0' )
            ->first();

        if ( $u == null ) {
            return redirect( '404' )->withErrors( [ 'mes' => 'Xác nhận email không thành công! Email hoặc mã xác thực không đúng. ' ] );
        } else {
            $kt  = Carbon::parse( $u->key_time );
            $now = Carbon::now();
            if ( $now->lt( $kt ) == true ) {
                $u->active     = 1;
                $u->key_time   = null;
                $u->random_key = null;
                $u->update();
//                $role = Role::find(1);
//                $u ->update(['role_id' => $role->id]);
                return redirect( 'login' )->with( 'ok', 'Xác nhận email thành công! Bạn có thể đăng nhập.' );
            } else {
                return redirect( '404' )->withErrors( [ 'mes' => 'Liên kết đã hết hạn!' ] );
            }
        }
    }


    private function messages() {
        return [
            'r_userName.required' => 'Bạn cần nhập họ tên',
            'r_userName.min' => 'Họ tên cần lớn hơn 3 kí tự',
            'r_userName.max' => 'Họ tên cần bé hơn 50 kí tự',
            'r_email.required' => 'Bạn cần nhập Email.',
            'r_email.email' => 'Định dạng Email bị sai.',
            'r_email.unique' => 'Email đã tồn tại',
            'r_birthday.required' => 'Bạn cần nhập ngày tháng năm sinh.',
            'r_birthday.min' => 'Tối thiểu bạn phải nhập năm sinh gồm 4 số',
            'r_birthday.max' => 'Bạn đã nhập quá kí tự cho phép. VD: 01/01/2021',
            'r_gender.required' => 'Bạn cần nhập giới tính',
            'r_gender.max' => 'Giới tính cần bé hơn 20 kí tự',
            'r_phone.required' => 'Bạn cần nhập số điện thoại liên lạc.',
            'r_phone.min' => 'Số điện thoại phải tối thiểu đủ 10 số',
            'r_phone.max' => 'Số điện thoại không được quá 11 số',
            'r_address.required' => 'Bạn cần nhập địa chỉ.',
            'r_pass.required' => 'Cần phải nhập mật khẩu đăng nhập.',
            'r_pass.min' => 'Mật khẩu phải đủ 8 ký tự trở lên.',
            're_pass.required' => 'Cần nhập xác nhận mật khẩu.',
            're_pass.same' => 'Xác nhận mật khẩu không trùng với mật khẩu.',
        ];
    }
}
