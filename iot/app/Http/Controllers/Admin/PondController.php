<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/10/2021
 * Time: 10:32 AM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Control;
use App\Models\ControlDelete;
use App\Models\Pond;
use App\Models\PondDelete;
use App\Models\Toolkit;
use App\Models\ToolkitDelete;
use App\Models\User;
use Faker\Provider\id_ID\Internet;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PondController extends Controller
{
    public function index()
    {
//        $ponds = DB::select('SELECT ponds.`id` ,ponds.`name`, ponds.address, users.`name` as name_user
//          FROM ponds, users
//          WHERE ponds.id_user=users.id');
//        $ponds = Pond::with('users')->where('active', '=', 0)->get();
        $ponds = Pond::all();
//        dd($ponds[0]->users->email);
//        return view('ponds.index', compact('ponds'));
        return view('ponds.index', ['ponds' => $ponds]);
    }

    public function viewPond($id_pond)
    {
        $pond = Pond::withCount('toolkits')->withCount('controls')
            ->where('id', '=', $id_pond)->get();
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

        $pond = Pond::where('id_user', '=', $request->user)
            ->where('name', '=', $request->name)->first();
        if ($pond==null){
            Pond::create([
                'id_user' => $request->user,
                'name' => $request->name,
                'address' => $request->address,
                'active' => 1,
                'created_date' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
            ]);
            Session::flash('success', 'Th??m m???i ao nu??i th??nh c??ng!');
            return redirect()->route('pond');
        } else {
            return redirect()->back()->withErrors(['name' => 'T??n ao nu??i n??y ???? t???n t???i!']);
        }
    }

    public function undoPond($id){
        $p = Pond::find($id);
        $p->active = 1;
        $p->created_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $p->update();
        Session::flash('success', 'Kh??i ph???c ao nu??i ho???t ?????ng l???i b??nh th?????ng!');
        return redirect()->route('pond');
    }

    public function delete($id)
    {
        $deletePond = Pond::find($id);
        PondDelete::insert( [
        'id'      => $deletePond->id,
        'id_user'   => $deletePond->id_user,
        'name' => $deletePond->name,
        'address' => $deletePond->address,
        'active' => $deletePond->active,
        'delete_date'   => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s')
    ] );

        $toolkit_IDPond = Toolkit::where('id_pond', '=', $id)->get();
        foreach ($toolkit_IDPond as $toolkit) {
            ToolkitDelete::insert([
                'id' => $toolkit->id,
                'id_pond' => $toolkit->id_pond,
                'id_temperature' => $toolkit->id_temperature,
                'id_ph' => $toolkit->id_ph,
                'id_light' => $toolkit->id_light,
                'name' => $toolkit->name,
                'address' => $toolkit->address,
                'delete_date' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s')
            ]);
        }
        $control_IDPond = Control::where('id_pond', '=', $id)->get();
        foreach ($control_IDPond as $control) {
            ControlDelete::insert([
                'id' => $control->id,
                'name' => $control->name,
                'address' => $control->address,
                'id_pond' => $control->id_pond,
                'id_pump_in' => $control->id_pump_in,
                'id_pump_out' => $control->id_pump_out,
                'id_lamp' => $control->id_lamp,
                'id_oxygen_fan' => $control->id_oxygen_fan,
                'delete_date' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s')
            ]);
        }
        if ($deletePond->delete()) {
            Session::flash('success', 'X??a ao nu??i th??nh c??ng!');
        } else {
            Session::flash('error', 'X??a ao nu??i th???t b???i!');
        }
        return redirect()->route('pond');
    }

    private function messages()
    {
        return [
            'name.required' => 'B???n c???n nh???p t??n ao nu??i',
            'address.required' => 'B???n c???n nh???p ?????a ch??? ao nu??i.',
            'user.required' => 'B???n c???n ch???n ng?????i s??? h???u.',
        ];
    }
}
