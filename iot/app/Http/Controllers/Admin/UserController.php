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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{
//    Table user
    public function index()
    {
        $data = User::all();
        return view('users.index', compact('data'));
    }

    //    Hiển thị thông tin một user
    public function viewUser($id)
    {
//        $user = [User::find($id)];
        $user = User::withCount('ponds')
            ->where('id', '=', $id)->get();
        return response()->json($user);
    }


//  Hiển thị view store user
    public function create()
    {
        return view('users.storeUser');
    }

//    Chức năng tạo tài khoản user (methot: post)
    public function storeUser(Request $request)
    {
        $request->validate([
            'r_email' => 'required|email',
            'r_userName' => 'required|min:3|max:50',
            'r_birthday' => 'required|min:4|max:10',
            'r_gender' => 'required|max:20',
            'r_phone' => 'required|min:10|max:11',
            'r_address' => 'required',
        ], $this->messages());
        $user = User::where('email', '=', $request->r_email)->first();
        // email không tồn tại gửi email mơi
        if ($user == null) {
            $token = Str::random(10);
            $u = User::create([
                'email' => $request->r_email,
                'password' => Hash::make($token),
                'name' => $request->r_userName,
                'birthday' => $request->r_birthday,
                'gender' => $request->r_gender,
                'phone' => $request->r_phone,
                'address' => $request->r_address,
                'random_key' => $token,
                'role_id' => 1,
                'key_time' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s')
            ]);
            $u->notify(new ActiveAccount());
            Session::flash('success', 'Tạo tài khoản Người dùng thành công!');
            return redirect()->back();
        } else {
            // đã tồn tại active 1 thông báo lỗi
            if ($user->active == 1) {
                Session::flash('error', 'Bạn vừa tạo tài khoản Người dùng thất bại!!!');
                return redirect()->back()->withErrors(['r_email' => 'Email này đã được đăng ký tài khoản khác!']);
            } else {
                // email tồn tại active =0 gửi lại email
                $token = Str::random(10);
//                $user->email = $request->r_email;
                $user->password = Hash::make($token);
                $user->name = $request->r_userName;
                $user->birthday = $request->r_birthday;
                $user->gender = $request->r_gender;
                $user->phone = $request->r_phone;
                $user->address = $request->r_address;
                $user->role_id = 1;
                $user->random_key = $token;
                $user->key_time = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
                $user->update();
                $user->notify(new ActiveAccount());
                Session::flash('success', 'Tạo tài khoản Người dùng thành công!');
                return redirect()->back();
            }
        }
    }

//    Chức năng tạo tài khoản Admin (methot: post)
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'ad_email' => 'required|email',
            'ad_userName' => 'required|min:3|max:50',
            'ad_pass' => 'required|min:8',
            'read_pass' => 'required|same:ad_pass',
        ], $this->messages());
        $user = User::where('email', '=', $request->ad_email)->first();
        // email không tồn tại gửi email mơi
        if ($user == null) {
//            $token = Str::random( 40 );
            $u = User::create([
                'email' => $request->ad_email,
                'password' => Hash::make($request->ad_pass),
                'name' => $request->ad_userName,
//                'random_key' => $token,
                'role_id' => 2,
                'active' => 1,
                'key_time' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s')
            ]);
            Session::flash('success', 'Bạn vừa tạo tài khoản Admin thành công!');
            return redirect()->back();
        } else {
            // đã tồn tại active 1 thông báo lỗi
            if ($user->active == 1) {
                Session::flash('error', 'Bạn vừa tạo tài khoản Admin thất bại!!!');
                return redirect()->back()->withErrors(['ad_email' => 'Email này đã được đăng ký tài khoản khác!']);
            } else {
                // email tồn tại active =0 gửi lại email
//                $token = Str::random(40);
//                $user->email = $request->ad_email;
                $user->password = Hash::make($request->ad_pass);
                $user->name = $request->ad_userName;
                $user->role_id = 2;
                $user->active = 1;
//                $user->random_key = $token;
                $user->key_time = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
                $user->update();
                Session::flash('success', 'Bạn vừa tạo tài khoản Admin thành công!');
                return redirect()->back();
            }
        }
    }

//    Hiển thị trang edit User
    public function edit($id)
    {
        $user = User::find($id);
//        dd($u);
        return view('users.edit', compact('user'));
    }

//    Cập nhật thông tin user
    public function update(Request $request, $id)
    {
        $request->validate([
            'edit_email' => 'required|email',
            'edit_name' => 'required|min:3|max:50',
            'edit_birthday' => 'required|min:4|max:10',
            'edit_phone' => 'required|min:10|max:11',
            'edit_address' => 'required',
        ], $this->messages());
        $u = User::find($id);
        $u->name = $request->edit_name;
        $u->email = $request->edit_email;
        $u->birthday = $request->edit_birthday;
        $u->phone = $request->edit_phone;
        $u->gender = $request->edit_gender;
        $u->address = $request->edit_address;
        $u->role_id = $request->edit_role;
        $u->active = $request->edit_active;
        if ($u->update()) {
//            update thành công
            Session::flash('success', 'Đã cập nhật thông tin tài khoản thành công!');
//            Kiểm tra user vừa cập nhật trùng vs tài khoản đăng nhập thì đăng xuất tài khoản đó
            if (($u->active == 0 && $u->id == Session::get('Auth')->id) || ($u->role_id == 1 && $u->id == Session::get('Auth')->id)) {
                return redirect()->route('getAdLogout');
            }
        } else {
            Session::flash('error', 'Cập nhật thông tin thất bại!!!');
        }
        return redirect()->back();
    }


    public function delete($u_id)
    {
        $deleteResult = User::find($u_id)->delete();
        if ($deleteResult) {
            Session::flash('success', 'Xóa tài khoản thành công!');
        } else {
            Session::flash('error', 'Xóa tài khoản thất bại!');
        }
        return redirect('user');
    }


//      Hàm active email khi tạo tài khoản user
    public function confirmEmail($email, $key)
    {
        $u = User::select('id', 'email', 'key_time', 'active')
            ->where('email', '=', $email)
            ->where('random_key', $key)
            ->where('active', '=', '0')
            ->first();
        if ($u == null) {
            return redirect('404')->withErrors(['mes' => 'Xác nhận email không thành công! Email hoặc mã xác thực không đúng. ']);
        } else {
            $kt = Carbon::parse($u->key_time);
            $now = Carbon::now();
            if ($now->lt($kt) == true) {
                $u->active = 1;
                $u->key_time = null;
                $u->random_key = null;
                $u->update();
                return redirect('login')->with('ok', 'Xác nhận email thành công! Bạn có thể đăng nhập.');
            } else {
                return redirect('404')->withErrors(['mes' => 'Liên kết đã hết hạn!']);
            }
        }
    }


    private function messages()
    {
        return [
            'r_userName.required' => 'Bạn cần nhập họ tên',
            'r_userName.min' => 'Họ tên cần lớn hơn 3 kí tự',
            'r_userName.max' => 'Họ tên cần bé hơn 50 kí tự',
            'ad_userName.required' => 'Bạn cần nhập họ tên',
            'ad_userName.min' => 'Họ tên cần lớn hơn 3 kí tự',
            'ad_userName.max' => 'Họ tên cần bé hơn 50 kí tự',
            'r_email.required' => 'Bạn cần nhập Email.',
            'r_email.email' => 'Định dạng Email bị sai.',
            'r_email.unique' => 'Email đã tồn tại',
            'ad_email.required' => 'Bạn cần nhập Email.',
            'ad_email.email' => 'Định dạng Email bị sai.',
            'ad_email.unique' => 'Email đã tồn tại',
            'r_birthday.required' => 'Bạn cần nhập ngày tháng năm sinh.',
            'r_birthday.min' => 'Tối thiểu bạn phải nhập năm sinh gồm 4 số',
            'r_birthday.max' => 'Bạn đã nhập quá kí tự cho phép. VD: 01/01/2021',
            'r_gender.required' => 'Bạn cần nhập giới tính',
            'r_gender.max' => 'Giới tính cần bé hơn 20 kí tự',
            'r_phone.required' => 'Bạn cần nhập số điện thoại liên lạc.',
            'r_phone.min' => 'Số điện thoại phải tối thiểu đủ 10 số',
            'r_phone.max' => 'Số điện thoại không được quá 11 số',
            'r_address.required' => 'Bạn cần nhập địa chỉ.',
            'ad_pass.required' => 'Cần phải nhập mật khẩu đăng nhập.',
            'ad_pass.min' => 'Mật khẩu phải đủ 8 ký tự trở lên.',
            'read_pass.required' => 'Cần nhập xác nhận mật khẩu.',
            'read_pass.same' => 'Xác nhận mật khẩu không trùng với mật khẩu.',
            'edit_name.required' => 'Bạn cần nhập họ tên',
            'edit_name.min' => 'Họ tên cần lớn hơn 3 kí tự',
            'edit_name.max' => 'Họ tên cần bé hơn 50 kí tự',
            'edit_email.required' => 'Bạn cần nhập Email.',
            'edit_email.email' => 'Định dạng Email bị sai.',
            'edit_email.unique' => 'Email đã tồn tại',
            'edit_birthday.required' => 'Bạn cần nhập ngày tháng năm sinh.',
            'edit_birthday.min' => 'Tối thiểu bạn phải nhập năm sinh gồm 4 số',
            'edit_birthday.max' => 'Bạn đã nhập quá kí tự cho phép. VD: 01/01/2021',
            'edit_phone.required' => 'Bạn cần nhập số điện thoại liên lạc.',
            'edit_phone.min' => 'Số điện thoại phải tối thiểu đủ 10 số',
            'edit_phone.max' => 'Số điện thoại không được quá 11 số',
            'edit_address.required' => 'Bạn cần nhập địa chỉ.',
        ];
    }
}
