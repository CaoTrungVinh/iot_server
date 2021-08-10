<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ForgotPassController;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForgotPass(){
        return view('auth.forgot_password');
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


    private function messages()
    {
        return [
            'email.required' => 'Bạn cần phải nhập Email.',
            'email.email' => 'Email sai định dạng.',
        ];
    }

}
