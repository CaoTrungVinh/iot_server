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
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function index(){
    $data = User::all();
    return view('users.index', compact('data'));
}

    public function showAddUser(){
        return view('users.addUser');
    }


    public function showEditUser($id){
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
}
