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
            Session::flash('success', 'Tạo bộ điều khiển thành công');
            return redirect()->route('reControl');
        }else{
            Session::flash('error', 'Tạo bộ điều khiển thất bại!');
            return redirect()->route('reControl');
        }
    }

    public function cancelRegisterControl($id){
        $control = Control::find($id);
        if ($control->delete()){
            Session::flash('success', 'Xóa bộ điều khiển khỏi danh sách đăng ký thành công');
            return redirect()->route('reControl');
        }else{
            Session::flash('error', 'Xóa bộ điều khiển khỏi danh sách đăng ký thất bại!');
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
                Session::flash('success', 'Thêm mới bộ điều khiển thành công!');
                return redirect()->route('control');
            } else {
                return redirect()->back()->withInput($request->only('sub_control'))->withErrors(['sub_control' => 'Thêm bộ điều khiển thất bại!']);
            }
        } else
            return redirect()->back()->withErrors(['nameControl' => 'Tên bộ điều khiển này đã tồn tại!']);
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
                Session::flash('success', 'Khôi phục bộ đo hoạt động lại bình thường!');
                return redirect()->route('control');
            }else {
                return redirect()->back()->withErrors(['id_pondControl' => 'Ao nuôi trong trạng thái tạm xóa!']);
            }
        }else {
            return redirect()->back()->withErrors(['nameControl' => 'Tên bộ đo này đã tồn tại!']);
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
//            Session::flash('success', 'Chỉnh sửa bộ điều khiển thành công!');
//        } else {
//            Session::flash('error', 'Chỉnh sửa bộ điều khiển thất bại!');
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
            Session::flash('success', 'Xóa bộ điều khiển thành công!');
        } else {
            Session::flash('error', 'Xóa bộ điều khiển thất bại!');
        }
        return redirect()->route('control');
    }

    private function messages()
    {
        return [
            'name.required' => 'Bạn cần nhập tên bộ điều khiển',
            'address.required' => 'Bạn cần nhập nơi để bộ điều khiển.',
            'id_pond.required' => 'Bạn cần chọn ao sở hữu.',
            'control_pumpIn.required' => 'Bạn cần chọn trạng thái hoạt động.',
            'control_pumpOut.required' => 'Bạn cần chọn trạng thái hoạt động.',
            'control_lamp.required' => 'Bạn cần chọn trạng thái hoạt động.',
            'control_oxy.required' => 'Bạn cần chọn trạng thái hoạt động.',
        ];
    }
}
