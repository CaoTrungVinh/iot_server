<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileUser extends Controller
{
//    Xem thong tin user
    public function profile()
    {
        $user = Auth::user();
        if (!$user->getAuthIdentifier())
            return response()->json(['message' => "Yêu cầu đăng nhập"], 500);
        $infos = User::where("id", "=", $user->getAuthIdentifier())->first();
        if (!$infos)
            return \response()->json([
                'message' => 'Unauthorized'
            ]);
        return response()->json($infos);
    }

//    Cập mhật thông tin
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:30',
            'phone' => 'nullable|regex:/^[\d\s]*$/|max:10|min:10',
            'birthday' => 'required',
            'gender' => 'required|string|max:4',
            'address' => 'required|string|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()->toArray(),
            ], 500);
        }
        $user = Auth::user();
        $accountID = $user->getAuthIdentifier();
        $acc = User::find($accountID);
        $acc->name = $request->name;
        $acc->birthday = $request->birthday;
        $acc->phone = $request->phone;
        $acc->gender = $request->gender;
        $acc->address = $request->address;
        if ($acc->save())
            return response()
                ->json(['successMessage' => 'Thay đổi thông tin thành công!'],200);
        return response()
            ->json(['errMessage' => 'Thay đổi thông tin thất bại!'], 500);

    }

//      Đổi pass
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'newPassword' => 'required|min:8',
            'newPasswordConfirm' => 'required|same:newPassword'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()->toArray(),
            ], 401);
        }
        $user = Auth::user();
        $accountID = $user->getAuthIdentifier();
        $account = User::find($accountID);
        $currentPassword = $request->currentPassword;
        $newPassword = $request->newPassword;
        $newPasswordConfirm = $request->newPasswordConfirm;

        if (!Hash::check($currentPassword, $account->password))
            return back()
                ->with(['errorMessage' => 'Mật khẩu hiện tại không đúng!']);
        if (Hash::check($newPassword, $account->password))
            return back()
                ->with(['errorMessage' => 'Mật khẩu mới không được trùng với mật khẩu cũ!']);
        $account->password = Hash::make($newPassword);
        if ($account->save())
            return response()
                ->json(['successMessage' => 'Thay đổi mật khẩu thành công!'], 200);
        return response()
            ->json(['errorMessage' => 'Thay đổi mật khẩu thất bại!'], 401);
    }
}
