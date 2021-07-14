<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ChangePasswordController extends Controller
{
    public function showChangePass(){
        return view('auth.changePass');
    }

    public function doChangePass(Request $request){
        $request->validate([
            'cur_pass' => 'required',
            'new_pass'    => 'required|min:8',
            'confirm_pass' => 'required|same:new_pass',
        ], $this->messages());
        $user = User::find(Session::get('Auth')->id);
        $currentPassword = $request->cur_pass;
        $newPassword = $request->new_pass;
        if (!Hash::check($currentPassword,$user->password))
            return redirect()->back()->withErrors(['cur_pass' => 'Mật khẩu hiện tại không đúng!']);
        if(Hash::check($newPassword,$user->password))
            return redirect()->back()->withErrors(['new_pass' => 'Mật khẩu mới không được trùng với mật khẩu cũ!']);
        $user->password =  Hash::make($newPassword);
        if ($user->update()){
//            Session::flash('success', 'Thay đổi mật khẩu thành công!');
            return redirect()->route('getAdLogout')->withErrors(['changePass' => 'Thay đổi mật khẩu thành công!']);
        }
        return redirect()->back()->withErrors(['mes' => 'Thay đổi mật khẩu thất bại!']);
    }


    private function messages()
    {
        return [
            'cur_pass.required' => 'Cần phải nhập mật khẩu cũ.',
            'new_pass.required' => 'Cần phải nhập mật khẩu mới.',
            'new_pass.min' => 'Mật khẩu mới phải đủ 8 ký tự trở lên.',
            'confirm_pass.required' => 'Cần phải nhập xác nhận lại mật khẩu mới.',
            'confirm_pass.same'        => 'Xác nhận mật khẩu không trùng với mật khẩu mới.',
        ];
    }
}
