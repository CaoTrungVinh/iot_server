<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ActiveAccount;
use App\Notifications\ForgotPassController;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserAuthController extends Controller
{

    public function register(Request $request)
    {
//        check dữ liệu nhập vào các thẻ input có hợp lệ hay không
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()->toArray(),
            ], 401);
        }
        $user = User::where('email', '=', $request->email)->first();
        $token = Str::random(10);
        // email không tồn tại gửi email mơi
        if ($user == null) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($token),
                'random_key' => $token,
                'role_id' => 1,
                'key_time' =>Carbon::now()->addHour(12)->format('Y-m-d H:i:s')
            ]);
            $user->notify(new ActiveAccount());
            return response()->json(['message'=>"Kiểm tra email để xác nhận tài khoản và xem mật khẩu được cấp!"],200);
        } else {
            // đã tồn tại active 1 thông báo lỗi
            if ($user->active == 1) {
                return response()->json(['message'=>"Tài khoản đã tồn tại!"],401);
            } else {
                // email tồn tại active = 0 gửi lại email
                $user->random_key = $token;
                $user->password = Hash::make($token);
                $user->key_time =Carbon::now()->addHour(12)->format('Y-m-d H:i:s');
                $user->update();
                $user->notify(new ActiveAccount());
                return response()->json(['message'=>"Kiểm tra email để xác nhận tài khoản và xem mật khẩu được cấp!"],200);
            }
        }
    }


    public function login(Request $request)
    {
        // kiem tra user trong database
        if (Auth::attempt(['email' => $request->get("email"), 'password' => $request->get("password")])) {
            // laays user tu database
            $user = Auth::user();
            if($user->active==1){
            // get accesstoken
            $accessToken = $user->createToken('AccessToken');
            // tra vee json chứa accesstoken
            $accessToken->token->save();
            $u = new User([
                'id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'birthday' => $user->birthday,
                'phone' => $user->phone,
                'gender' => $user->gender,
                'address' => $user->address,
                'role_id' => $user->role_id
            ]);
            return response()->json([
                'access_token' => $accessToken->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $accessToken->token->expires_at
                )->toDateTimeString(),
                'user' => $u,
            ], 200);
            }else{
                return response()->json(['mesage' => 'Tài khoản chưa được kích hoạt hoặc không phải là người dùng'], 401);
            }
        } else {
            return response()->json(['mesage' => 'Unauthorized'], 401);
        }
    }


    public function forgotPass(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()->toArray(),
            ], 401);
        }
        $user = User::where('email', '=', $request->email)->first();
        // email không tồn tại hoặc chưa được active
        if ($user == null) {
            return response()->json(['message'=>"Tài khoản không tồn tại!"],401);
        }else{
            if ($user->active == 0) {
                return response()->json(['message'=>"Tài khoản chưa được kích hoạt!"],401);
            } else {
                $token = Str::random(8);
                $user->random_key = $token;
                $user->password = Hash::make($token);
//                $user->key_time = Carbon::now()->addHour(12)->format('Y-m-d H:i:s');
                $user->update();
                $user->notify(new ForgotPassController());
                $user->random_key = null;
                $user->key_time = null;
                $user->update();
                return response()->json(['message'=>"Kiểm tra email để xem passwor được cấp mới!"],200);
            }
        }
    }

    public function user(Request $request)
{
    return response()->json($request->user());
}

    public function logout(Request $request)
{
    // xoa token trong table user
    $request->user()->token()->revoke();
    return response()->json([
        'status' => "200",
        'message' => 'Successfully logged out'
    ]);
}
}
