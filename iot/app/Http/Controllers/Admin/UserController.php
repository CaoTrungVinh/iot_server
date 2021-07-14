<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/8/2021
 * Time: 3:35 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ActiveAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(){
    $data = User::all();
    return view('users.index', compact('data'));
}
//  Hiển thị view store user
    public function create(){
        return view('users.storeUser');
    }

//    Chức năng tạo tài khoản user (methot: post)
    public function store(Request $request)
    {
        $request->validate([
            'r_email'     => 'required|email',
            'r_userName' => 'required|min:3|max:50',
            'r_birthday'     => 'required|min:4|max:10',
            'r_gender'     => 'required|max:20',
            'r_phone'     => 'required|min:10|max:11',
            'r_address'     => 'required',
        ], $this->messages());
        $user = User::where( 'email', '=', $request->r_email )->first();
        // email không tồn tại gửi email mơi
        if ( $user == null ) {
            $token = Str::random( 10 );
            $user  = User::create( [
                'email'      => $request->r_email,
                'password'   => Hash::make($token),
                'name' => $request->r_userName,
                'birthday' => $request->r_birthday,
                'gender' => $request->r_gender,
                'phone' => $request->r_phone,
                'address' => $request->r_address,
                'random_key' => $token,
                'role_id' => 1,
                'key_time'   => Carbon::now()->addHour( 12 )->format( 'Y-m-d H:i:s' )
            ] );

            $user->notify( new ActiveAccount() );

            return redirect()->back()->withInput($request->only('ok'))->withErrors(['ok' => 'Tạo tài khoản thành công - kiểm tra email để kích hoạt tài khoản và lấy mật khẩu đăng nhập.']);
        } else {
            // đã tồn tại active 1 thông báo lỗi
            if ($user->active == 1) {
                return redirect()->back()->withErrors(['r_email' => 'Email này đã được đăng ký tài khoản khác!']);
            } else {
                // email tồn tại active =0 gửi lại email
                $token = Str::random(10);
                $user->email = $request->r_email;
                $user->password = Hash::make($token);
                $user->name = $request->r_userName;
                $user->birthday = $request->r_birthday;
                $user->gender = $request->r_gender;
                $user->phone = $request->r_phone;
                $user->address = $request->r_address;
                $user->role_id = 1;
                $user->random_key = $token;
                $user->key_time = Carbon::now()->addHour(12)->format('Y-m-d H:i:s');
                $user->update();
                $user->notify(new ActiveAccount());

                return redirect()->back()->withInput($request->only('ok'))->withErrors(['ok' => 'Tạo tài khoản thành công - kiểm tra email để kích hoạt tài khoản và lấy mật khẩu đăng nhập.']);
            }
        }
    }

    public function viewUser($id){
        $user = User::find( $id );
        return response()->json($user);
    }

    public function edit($id){
        $user = User::find( $id );
//        dd($u);
        return view('users.edit', compact('user'));
    }

//    public function showEditUser(){
////        $user = User::find( $id );
////        dd($u);
//        return view('users.edit');
//    }


//    public function edit(Request $request, $id){
//        $data = User::all();
//        return view('users.edit');
//    }


//      Hàm active email khi tạo tài khoản
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
                return redirect( 'verifile' )->with( 'ok', 'Xác nhận email thành công! Bạn có thể đăng nhập.' );
            } else {
                return redirect( '404' )->withErrors( [ 'mes' => 'Liên kết đã hết hạn!' ] );
            }
        }
    }


    private function messages() {
        return [
            'r_userName.required' => 'Bạn cần nhập họ tên',
            'r_userName.min'      => 'Họ tên cần lớn hơn 3 kí tự',
            'r_userName.max'      => 'Họ tên cần bé hơn 50 kí tự',
            'r_email.required'     => 'Bạn cần nhập Email.',
            'r_email.email'        => 'Định dạng Email bị sai.',
            'r_email.unique'       => 'Email đã tồn tại',
            'r_birthday.required'      => 'Bạn cần nhập ngày tháng năm sinh.',
            'r_birthday.min'           => 'Tối thiểu bạn phải nhập năm sinh gồm 4 số',
            'r_birthday.max'        => 'Bạn đã nhập quá kí tự cho phép. VD: 01/01/2021',
            'r_gender.required'      => 'Bạn cần nhập giới tính',
            'r_gender.max'        => 'Giới tính cần bé hơn 20 kí tự',
            'r_phone.required'      => 'Bạn cần nhập số điện thoại liên lạc.',
            'r_phone.min'           => 'Số điện thoại phải tối thiểu đủ 10 số',
            'r_phone.max'        => 'Số điện thoại không được quá 11 số',
            'r_address.required'      => 'Bạn cần nhập địa chỉ.',
        ];
    }
}
