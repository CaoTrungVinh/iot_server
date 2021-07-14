<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProfileAdminController extends Controller
{
    public function showProfile(){
        return view('pages.profile');
    }

    public function updateProfile(Request $request){
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
        $acc = User::find(Session::get('Auth')->id);
        $acc->name = $request->p_name;
        $acc->birthday = $request->p_birthday;
        $acc->phone = $request->p_phone;
        $acc->gender = $request->p_gender;
        $acc->address = $request->p_address;
        if ($acc->update()){
            Session::put('Auth', $acc);
            Session::flash('success', 'Cập nhật thông tin thành công!');
        }else {
            Session::flash('error', 'Cập nhật thông tin thất bại!!!');
        }
        return redirect()->back();
    }

}
