<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ForgotPassController;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserAuthController extends Controller
{
    public function showForgotPass(){
        return view('auth.userForgotPass');
    }

    public function doForgotPass(Request $request){
        $request->validate([
            'email' => 'required|email',
        ], $this->messages());

        $user = User::where('email', '=', $request->email)->first();
        // email không tồn tại hoặc chưa được active
        if ($user == null) {
            return redirect()->back()->withInput($request->only('email'))->withErrors(['mes' => 'Email chưa được đăng ký!']);
        }else{
            if ($user->active == 0) {
                return redirect()->back()->withInput($request->only('email'))->withErrors(['mes' => 'Email chưa được kích hoạt!']);
            } else {
                $token = Str::random(8);
                $user->random_key = $token;
                $user->password = Hash::make($token);
                $user->key_time = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
                $user->update();
                $user->notify(new ForgotPassController());
                $user->random_key = null;
                $user->key_time = null;
                $user->update();
                return redirect()->back()->withInput($request->only('sendMail'))->withErrors(['sendMail' => 'Gửi mail thành công - Hãy kiểm tra email!!!']);
            }
        }
    }

    public function showProfileUser(){
        return view('pages.userProfile');
    }

    public function userChangePass(){
        return view('auth.userChangePass');
    }

    public function updateProfileUser(Request $request){
        $validator = Validator::make($request->all(), [
            'p_name' => 'required|min:3|max:50',
            'p_birthday'     => 'required|min:4|max:10',
            'p_phone'     => 'required|min:10|max:11',
            'p_address'     => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error', 'Cập nhật thông tin thất bại!!!');
            return redirect()->back();
        }
        $acc = User::find(Session::get('User')->id);
        $acc->name = $request->p_name;
        $acc->birthday = $request->p_birthday;
        $acc->phone = $request->p_phone;
        $acc->gender = $request->p_gender;
        $acc->address = $request->p_address;
        if ($acc->update()){
            Session::put('User', $acc);
            Session::flash('success', 'Cập nhật thông tin thành công!');
        }else {
            Session::flash('error', 'Cập nhật thông tin thất bại!!!');
        }
        return redirect()->back();
    }

    public function doChangePass(Request $request){
        $request->validate([
            'cur_pass' => 'required',
            'new_pass'    => 'required|min:8',
            'confirm_pass' => 'required|same:new_pass',
        ], $this->messages());
        $user = User::find(Session::get('User')->id);
        $currentPassword = $request->cur_pass;
        $newPassword = $request->new_pass;
        if (!Hash::check($currentPassword,$user->password))
            return redirect()->back()->withErrors(['cur_pass' => 'Mật khẩu hiện tại không đúng!']);
        if(Hash::check($newPassword,$user->password))
            return redirect()->back()->withErrors(['new_pass' => 'Mật khẩu mới không được trùng với mật khẩu cũ!']);
        $user->password =  Hash::make($newPassword);
        if ($user->update()){
//            Session::flash('success', 'Thay đổi mật khẩu thành công!');
            return redirect()->route('getUsLogout')->withErrors(['changePass' => 'Thay đổi mật khẩu thành công!']);
        }
        return redirect()->back()->withErrors(['mes' => 'Thay đổi mật khẩu thất bại!']);
    }


    private function messages()
    {
        return [
            'email.required' => 'Bạn cần phải nhập Email.',
            'email.email' => 'Email sai định dạng.',
            'cur_pass.required' => 'Cần phải nhập mật khẩu cũ.',
            'new_pass.required' => 'Cần phải nhập mật khẩu mới.',
            'new_pass.min' => 'Mật khẩu mới phải đủ 8 ký tự trở lên.',
            'confirm_pass.required' => 'Cần phải nhập xác nhận lại mật khẩu mới.',
            'confirm_pass.same'        => 'Xác nhận mật khẩu không trùng với mật khẩu mới.',
        ];
    }

}
