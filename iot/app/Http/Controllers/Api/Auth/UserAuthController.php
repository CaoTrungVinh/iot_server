<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
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
}
