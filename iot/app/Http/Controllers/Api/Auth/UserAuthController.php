<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ActiveAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserAuthController extends Controller
{

    public function register(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'pass' => 'required|min:8',
            'repass' => 'required|same:pass',
        ], $this->messages());
        $user = User::where('email', '=', $request->email)->first();
        // email không tồn tại gửi email mơi
        if ($user == null) {
            $token = Str::random(40);
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->pass),
                'random_key' => $token,
                'key_time' =>Carbon::now()->addHour(12)->format('Y-m-d H:i:s')
            ]);
            $user->notify(new ActiveAccount());
            return response()->json(['message'=>"Kiểm tra email để xác nhận tài khoản"],200);
        } else {
            // đã tồn tại active 1 thông báo lỗi
            if ($user->active == 1) {
                return response()->json(['message'=>"Tài khoản đã tồn tại!"],401);
            } else {
                // email tồn tại active = 0 gửi lại email
                $token = Str::random(40);
                $user->keyActive = $token;
                $user->keyTime =Carbon::now()->addHour(12)->format('Y-m-d H:i:s');
                $user->update();
                $user->notify(new ActiveAccount());
                return response()->json(['message'=>"Kiểm tra email để xác nhận tài khoản"],200);
            }
        }
    }

    function login(Request $request)
    {
        // kiem tra user trong database
        if (Auth::attempt(['email' => $request->get("email"), 'password' => $request->get("password")])) {
            // laays user tu database
            $user = Auth::user();
            // get accesstoken
            $accessToken = $user->createToken('AccessToken');
            // tra vee json chứa accesstoken
            $accessToken->token->save();
            $u = new User([
                'id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'role_id' => $user->role_id
            ]);
            return response()->json([
                'access_token' => $accessToken->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $accessToken->token->expires_at
                )->toDateTimeString(),
                'user' => $u,
            ]);
        } else {
            return response()->json(['mesage' => 'Unauthorized']);
        }
    }

    private function messages()
    {
        return [
            'email.required' => 'Email is required.',
            'email.email' => 'Wrong email format.',
            'email.unique' => 'Email is available',
            'name.required' => 'Name is required',
            'pass.required' => 'Password is required',
            'pass.min' => 'Password is required at least 8 characters',
            'pass.required' => 'Repassword is required',
            'repass.same' => 'Password and repassword do not match',
        ];
    }
}
