<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/11/2021
 * Time: 2:52 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Control;
use App\Models\ControlDelete;
use App\Models\Lamp;
use App\Models\Oxygen_fan;
use App\Models\Pond;
use App\Models\Pump_In;
use App\Models\Pump_out;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ControlController extends Controller
{
    public function index()
    {
        $controls = DB::select('SELECT control.*, ponds.id as idPond, ponds.`name` as name_pond, ponds.active as activePond
FROM control, ponds
WHERE control.id_pond = ponds.id');
        return view('controls.index', compact('controls'));
    }

    public function showIndexRegisControl(){
        $control = DB::select('SELECT control.*, ponds.id as idPond, ponds.`name` as name_pond, ponds.active as activePond, users.id as idUser, users.`name` as userName, users.phone, users.address as addUser
FROM control, ponds, users
WHERE control.id_pond = ponds.id AND ponds.id_user = users.id AND control.active = 0');
        return view('controls.indexRegisControl')->with(['control' => $control]);
    }

    public function okRegisterControl($id){
        $control = Control::find($id);
        $pumpIn = Pump_In::create([
            "status" => 0,
            "timer_on" => 0,
            "timer_off" => 0,
        ]);
        $pumpOut = Pump_out::create([
            "status" => 0,
            "timer_on" => 0,
            "timer_off" => 0,
        ]);
        $lamp = Lamp::create([
            "status" => 0,
            "timer_on" => 0,
            "timer_off" => 0,
        ]);
        $oxygen = Oxygen_fan::create([
            "status" => 0,
            "timer_on" => 0,
            "timer_off" => 0,
        ]);
        $control->id_pump_in = $pumpIn->id;
        $control->id_pump_out = $pumpOut->id;
        $control->id_lamp = $lamp->id;
        $control->id_oxygen_fan = $oxygen->id;
        $control->active = 4;
        $control->key_active = Str::random(4);
        $control->create_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        if ($control->update()){
            Session::flash('success', 'T???o b??? ??i???u khi???n th??nh c??ng');
            return redirect()->route('reControl');
        }else{
            Session::flash('error', 'T???o b??? ??i???u khi???n th???t b???i!');
            return redirect()->route('reControl');
        }
    }

    public function cancelRegisterControl($id){
        $control = Control::find($id);
        if ($control->delete()){
            Session::flash('success', 'X??a b??? ??i???u khi???n kh???i danh s??ch ????ng k?? th??nh c??ng');
            return redirect()->route('reControl');
        }else{
            Session::flash('error', 'X??a b??? ??i???u khi???n kh???i danh s??ch ????ng k?? th???t b???i!');
            return redirect()->route('reControl');
        }
    }

    public function viewControl($id)
    {
        $control = Control::find($id);
        $pond = Pond::where('id', '=', $control->id_pond)->first();
        $user = User::where('id', '=', $pond->id_user)->first();
        return response()->json([$control, $pond, $user]);
    }

    public function create()
    {
        $controls_create = Pond::all();
        return view('controls.store', compact('controls_create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nameControl' => 'required',
            'addressControl' => 'required',
            'idPond' => 'required',
        ], $this->messages());

        $c = Control::where('name', '=', $request->nameControl)
            ->where('id_pond', '=', $request->idPond)->first();
        if ($c == null) {
            $pumpIn = Pump_In::create([
                "status" => 0,
                "timer_on" => 0,
                "timer_off" => 0,
            ]);
            $pumpOut = Pump_out::create([
                "status" => 0,
                "timer_on" => 0,
                "timer_off" => 0,
            ]);
            $lamp = Lamp::create([
                "status" => 0,
                "timer_on" => 0,
                "timer_off" => 0,
            ]);
            $oxygen = Oxygen_fan::create([
                "status" => 0,
                "timer_on" => 0,
                "timer_off" => 0,
            ]);
            $pumpIn_id = $pumpIn->id;
            $pumpout_id = $pumpOut->id;
            $lamp_id = $lamp->id;
            $oxy_id = $oxygen->id;

            $control = Control::create([
                "id_pond" => $request->get("idPond"),
                "id_pump_in" => $pumpIn_id,
                "id_pump_out" => $pumpout_id,
                "id_lamp" => $lamp_id,
                "id_oxygen_fan" => $oxy_id,
                "name" => $request->get("nameControl"),
                "address" => $request->get("addressControl"),
                'active' => 4,
                'key_active' => Str::random(4),
                'create_date' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s')
            ]);
            if ($control) {
                Session::flash('success', 'Th??m m???i b??? ??i???u khi???n th??nh c??ng!');
                return redirect()->route('control');
            } else {
                return redirect()->back()->withInput($request->only('sub_control'))->withErrors(['sub_control' => 'Th??m b??? ??i???u khi???n th???t b???i!']);
            }
        } else
            return redirect()->back()->withErrors(['nameControl' => 'T??n b??? ??i???u khi???n n??y ???? t???n t???i!']);
    }

    public function showViewUndo($id){
        $control = Control::find($id);
        $pond = Pond::where('id', '=', $control->id_pond)->first();
        $user = User::where('id', '=', $pond->id_user)->first();
        $pondAll = Pond::all();
        return view('controls.edit')->with([
            'control' => $control,
            'pond' => $pond,
            'user' => $user,
            'pondAll' => $pondAll,
        ]);
    }

    public function undoControl(Request $request, $id){
        $request->validate([
            'nameControl' => 'required',
            'addressControl' => 'required',
            'id_pondControl' => 'required',
        ], $this->messages());
        $c = Control::where('name', '=', $request->nameTool)
            ->where('id_pond', '=', $request->id_pondControl)->first();
        if($c==null || $c->id == $id){
            $pond = Pond::where('id', '=', $request->id_pondControl)->first();
            if($pond->active != 3) {
                $control = Control::find($id);
                $control->name = $request->nameControl;
                $control->address = $request->addressControl;
                $control->id_pond = $request->id_pondControl;
                $control->active = 2;
                $control->create_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
                $control->update();
                Session::flash('success', 'Kh??i ph???c b??? ??o ho???t ?????ng l???i b??nh th?????ng!');
                return redirect()->route('control');
            }else {
                return redirect()->back()->withErrors(['id_pondControl' => 'Ao nu??i trong tr???ng th??i t???m x??a!']);
            }
        }else {
            return redirect()->back()->withErrors(['nameControl' => 'T??n b??? ??o n??y ???? t???n t???i!']);
        }

    }

//    public function edit($id)
//    {
//        $pondall = Pond::all();
//        $controlId = Control::all()->where('id', $id)->first();
//        $pondId = Pond::all()->where('id', $controlId->id_pond)->first();
//        $pumpInId = Pump_In::all()->where('id', $controlId->id_pump_in)->first();
//        $pumpOutId = Pump_out::all()->where('id', $controlId->id_pump_out)->first();
//        $lampId = Lamp::all()->where('id', $controlId->id_lamp)->first();
//        $oxygenId = Oxygen_fan::all()->where('id', $controlId->id_oxygen_fan)->first();
//        return view('controls.edit', ['pondall' => $pondall, 'controlId' => $controlId, 'pondId' => $pondId, 'pumpInId' => $pumpInId, 'pumpOutId' => $pumpOutId, 'lampId' => $lampId, 'oxygenId' => $oxygenId]);
//    }
//
//    public function update(Request $request)
//    {
//        $request->validate([
//            'name' => 'required',
//            'address' => 'required',
//            'id_pond' => 'required',
//            'control_pumpIn' => 'required',
//            'control_pumpOut' => 'required',
//            'control_lamp' => 'required',
//            'control_oxy' => 'required',
//        ], $this->messages());
//
//        $control = DB::table('control')->where('id', $request->id)->update([
//            'id_pond' => $request->id_pond,
//            'name' => $request->name,
//            'address' => $request->address,
//        ]);
//        $quest = Control::all()->where('id', $request->id)->first();
//        $pumpIn_id = $quest->id_pump_in;
//        $pumpOut_id = $quest->id_pump_out;
//        $lamp_id = $quest->id_lamp;
//        $oxy_id = $quest->id_oxygen_fan;
//
//        $pumpIn = DB::table('pump_in')->where('id', $pumpIn_id)->update([
//            "status" => $request->get("control_pumpIn"),
//            "timer_on" => $request->get("timer_pumpIn_On"),
//            "timer_off" => $request->get("timer_pumpIn_Off"),
//        ]);
//        $pumpout = DB::table('pump_out')->where('id', $pumpOut_id)->update([
//            "status" => $request->get("control_pumpOut"),
//            "timer_on" => $request->get("timer_pumpOut_On"),
//            "timer_off" => $request->get("timer_pumpOut_Off"),
//        ]);
//        $lamp = DB::table('lamp')->where('id', $lamp_id)->update([
//            "status" => $request->get("control_lamp"),
//            "timer_on" => $request->get("timer_lamp_On"),
//            "timer_off" => $request->get("timer_lamp_Off"),
//        ]);
//        $oxygen = DB::table('oxygen_fan')->where('id', $oxy_id)->update([
//            "status" => $request->get("control_oxy"),
//            "timer_on" => $request->get("timer_oxy_On"),
//            "timer_off" => $request->get("timer_oxy_Off"),
//        ]);
//        if ($pumpIn || $pumpout || $lamp || $oxygen) {
//            Session::flash('success', 'Ch???nh s???a b??? ??i???u khi???n th??nh c??ng!');
//        } else {
//            Session::flash('error', 'Ch???nh s???a b??? ??i???u khi???n th???t b???i!');
//        }
//        return redirect('control');
//    }

    public function delete($id)
    {
        $deleteControl = Control::find($id);
        ControlDelete::insert([
            'id' => $deleteControl->id,
            'name' => $deleteControl->name,
            'address' => $deleteControl->address,
            'id_pond' => $deleteControl->id_pond,
            'id_pump_in' => $deleteControl->id_pump_in,
            'id_pump_out' => $deleteControl->id_pump_out,
            'id_lamp' => $deleteControl->id_lamp,
            'id_oxygen_fan' => $deleteControl->id_oxygen_fan,
            'key_active' => $deleteControl->key_active,
            'date_active' => $deleteControl->date_active,
            'delete_date' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s')
        ]);

        if ($deleteControl->delete()) {
            Session::flash('success', 'X??a b??? ??i???u khi???n th??nh c??ng!');
        } else {
            Session::flash('error', 'X??a b??? ??i???u khi???n th???t b???i!');
        }
        return redirect()->route('control');
    }

    private function messages()
    {
        return [
            'name.required' => 'B???n c???n nh???p t??n b??? ??i???u khi???n',
            'address.required' => 'B???n c???n nh???p n??i ????? b??? ??i???u khi???n.',
            'id_pond.required' => 'B???n c???n ch???n ao s??? h???u.',
            'control_pumpIn.required' => 'B???n c???n ch???n tr???ng th??i ho???t ?????ng.',
            'control_pumpOut.required' => 'B???n c???n ch???n tr???ng th??i ho???t ?????ng.',
            'control_lamp.required' => 'B???n c???n ch???n tr???ng th??i ho???t ?????ng.',
            'control_oxy.required' => 'B???n c???n ch???n tr???ng th??i ho???t ?????ng.',
        ];
    }
}
