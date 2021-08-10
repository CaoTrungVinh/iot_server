<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/10/2021
 * Time: 10:32 AM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pond;
use App\Models\User;
use Faker\Provider\id_ID\Internet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PondController extends Controller
{
    public function index()
    {
//        $ponds = DB::select('SELECT ponds.`id` ,ponds.`name`, ponds.address, users.`name` as name_user
//          FROM ponds, users
//          WHERE ponds.id_user=users.id');
        $ponds = Pond::with('users')->where('active', '=', 0)->get();
//        dd($ponds[0]->users->email);
//        return view('ponds.index', compact('ponds'));
        return view('ponds.index', ['ponds' => $ponds]);
    }

    public function viewPond($id_pind)
    {
        $pond = Pond::withCount('tollkits')->withCount('controls')
            ->where('id', '=', $id_pind)->get();
        return response()->json($pond);
    }

    public function create()
    {
        $pond_create = DB::select('SELECT users.`name`, users.`id`
          FROM users
          WHERE users.active = 1');
        return view('ponds.store', compact('pond_create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'user' => 'required',
        ], $this->messages());

        $allRequest = $request->all();
        $name = $allRequest['name'];
        $user = $allRequest['user'];
        $address = $allRequest['address'];

        $dataInsertToDatabase = array(
            'id_user' => $user,
            'name' => $name,
            'address' => $address,
        );
        $insertData = DB::table('ponds')->insert($dataInsertToDatabase);

        if ($insertData) {
            Session::flash('success', 'Thêm mới ao nuôi thành công!');
        } else {
            Session::flash('error', 'Thêm ao nuôi thất bại!');
        }
        return redirect('pond');
    }

    public function edit($id)
    {
        $getDataId = Pond::with('users')->where('id', $id)->first();
        $getData = User::all()->where('active', 1);
        return view('ponds.edit', ['getDataId' => $getDataId, 'getData' => $getData]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'user' => 'required',
        ], $this->messages());

        $updateData = DB::table('ponds')->where('id', $request->id)->update([
            'id_user' => $request->user,
            'name' => $request->name,
            'address' => $request->address,
        ]);

        if ($updateData) {
            Session::flash('success', 'Chỉnh sửa ao nuôi thành công!');
        } else {
            Session::flash('error', 'Chỉnh sửa ao nuôi thất bại!');
        }
        return redirect('pond');
    }

    public function delete($id)
    {
        $deleteData = DB::table('ponds')->where('id', '=', $id)->delete();
        if ($deleteData) {
            Session::flash('success', 'Xóa ao nuôi thành công!');
        } else {
            Session::flash('error', 'Xóa ao nuôi thất bại!');
        }
        return redirect('pond');
    }

    private function messages()
    {
        return [
            'name.required' => 'Bạn cần nhập tên ao nuôi',
            'address.required' => 'Bạn cần nhập địa chỉ ao nuôi.',
            'user.required' => 'Bạn cần chọn người sở hữu.',
        ];
    }
}
