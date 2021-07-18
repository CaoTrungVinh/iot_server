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
use App\Models\Lamp;
use App\Models\Oxygen_fan;
use App\Models\Pond;
use App\Models\Pump_In;
use App\Models\Pump_out;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ControlController extends Controller
{
    public function index()
    {
        $controls = DB::select('SELECT control.`id`,ponds.`name` as name_pond, control.`name` as name_control, control.address, pump_in.`status` as pump_in, pump_out.`status` as pump_out, lamp.`status` as lamp, oxygen_fan.`status` as oxygen_fan
          FROM ponds, control, pump_in, pump_out, lamp, oxygen_fan
          WHERE control.id_pond = ponds.id and control.id_pump_in = pump_in.id and control.id_pump_out = pump_out.id and control.id_lamp = lamp.id and control.id_oxygen_fan = oxygen_fan.id');
        return view('controls.index', compact('controls'));
    }

    public function viewControl($id)
    {
        $control = Control::find($id);
        $control_pumpIn = Control::find($id)->pumpIns;
        $control_pumpOut = Control::find($id)->pumpOut;
        $control_lamp = Control::find($id)->lamps;
        $control_oxygen = Control::find($id)->oxygen;
        return response()->json([$control, $control_pumpIn, $control_pumpOut, $control_lamp, $control_oxygen]);
    }

    public function create()
    {
        $controls_create = Pond::all();
        return view('controls.store', compact('controls_create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'id_pond' => 'required',
            'control_pumpIn' => 'required',
            'control_pumpOut' => 'required',
            'control_lamp' => 'required',
            'control_oxy' => 'required',
        ], $this->messages());

        $pumpIn = Pump_In::create([
            "status" => $request->get("control_pumpIn"),
            "timer_on" => $request->get("timer_pumpIn_On"),
            "timer_off" => $request->get("timer_pumpIn_Off"),
        ]);
        $pumpOut = Pump_out::create([
            "status" => $request->get("control_pumpOut"),
            "timer_on" => $request->get("timer_pumpOut_On"),
            "timer_off" => $request->get("timer_pumpOut_Off"),
        ]);
        $lamp = Lamp::create([
            "status" => $request->get("control_lamp"),
            "timer_on" => $request->get("timer_lamp_On"),
            "timer_off" => $request->get("timer_lamp_Off"),
        ]);
        $oxygen = Oxygen_fan::create([
            "status" => $request->get("control_oxy"),
            "timer_on" => $request->get("timer_oxy_On"),
            "timer_off" => $request->get("timer_oxy_Off"),
        ]);
        $pumpIn_id = $pumpIn->id;
        $pumpout_id = $pumpOut->id;
        $lamp_id = $lamp->id;
        $oxy_id = $oxygen->id;

        $control = Control::create([
            "id_pond" => $request->get("id_pond"),
            "id_pump_in" => $pumpIn_id,
            "id_pump_out" => $pumpout_id,
            "id_lamp" => $lamp_id,
            "id_oxygen_fan" => $oxy_id,
            "name" => $request->get("name"),
            "address" => $request->get("address"),
        ]);
        if ($control) {
            Session::flash('success', 'Thêm mới bộ điều khiển thành công!');
        } else {
            Session::flash('error', 'Thêm bộ điều khiển thất bại!');
        }
        return redirect('control');
    }

    public function edit($id)
    {
        $pondall = Pond::all();
        $controlId = Control::all()->where('id', $id)->first();
        $pondId = Pond::all()->where('id', $controlId->id_pond)->first();
        $pumpInId = Pump_In::all()->where('id', $controlId->id_pump_in)->first();
        $pumpOutId = Pump_out::all()->where('id', $controlId->id_pump_out)->first();
        $lampId = Lamp::all()->where('id', $controlId->id_lamp)->first();
        $oxygenId = Oxygen_fan::all()->where('id', $controlId->id_oxygen_fan)->first();
        return view('controls.edit',['pondall' => $pondall, 'controlId' => $controlId, 'pondId' => $pondId, 'pumpInId' => $pumpInId, 'pumpOutId' => $pumpOutId, 'lampId' => $lampId, 'oxygenId' => $oxygenId]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'id_pond' => 'required',
            'control_pumpIn' => 'required',
            'control_pumpOut' => 'required',
            'control_lamp' => 'required',
            'control_oxy' => 'required',
        ], $this->messages());

        $control = DB::table('control')->where('id', $request->id)->update([
            'id_pond' => $request->id_pond,
            'name' => $request->name,
            'address' => $request->address,
        ]);
        $quest = Control::all()->where('id', $request->id)->first();
        $pumpIn_id = $quest->id_pump_in;
        $pumpOut_id = $quest->id_pump_out;
        $lamp_id = $quest->id_lamp;
        $oxy_id = $quest->id_oxygen_fan;

        $pumpIn = DB::table('pump_in')->where('id', $pumpIn_id)->update([
            "status" => $request->get("control_pumpIn"),
            "timer_on" => $request->get("timer_pumpIn_On"),
            "timer_off" => $request->get("timer_pumpIn_Off"),
        ]);
        $pumpout = DB::table('pump_out')->where('id', $pumpOut_id)->update([
            "status" => $request->get("control_pumpOut"),
            "timer_on" => $request->get("timer_pumpOut_On"),
            "timer_off" => $request->get("timer_pumpOut_Off"),
        ]);
        $lamp = DB::table('lamp')->where('id', $lamp_id)->update([
            "status" => $request->get("control_lamp"),
            "timer_on" => $request->get("timer_lamp_On"),
            "timer_off" => $request->get("timer_lamp_Off"),
        ]);
        $oxygen = DB::table('oxygen_fan')->where('id', $oxy_id)->update([
            "status" => $request->get("control_oxy"),
            "timer_on" => $request->get("timer_oxy_On"),
            "timer_off" => $request->get("timer_oxy_Off"),
        ]);
        if ($pumpIn || $pumpout || $lamp || $oxygen) {
            Session::flash('success', 'Chỉnh sửa bộ điều khiển thành công!');
        } else {
            Session::flash('error', 'Chỉnh sửa bộ điều khiển thất bại!');
        }
        return redirect('control');
    }
    public function delete($id)
    {
        $quest = Control::all()->where('id', $id)->first();
        $pumpIn_id = $quest->id_pump_in;
        $pumpOut_id = $quest->id_pump_out;
        $lamp_id = $quest->id_lamp;
        $oxy_id = $quest->id_oxygen_fan;

        $deletePumpIn = DB::table('pump_in')->where('id', '=', $pumpIn_id)->delete();
        $deletePumpOut = DB::table('pump_out')->where('id', '=', $pumpOut_id)->delete();
        $deleteLamp = DB::table('lamp')->where('id', '=', $lamp_id)->delete();
        $deleteOxy = DB::table('oxygen_fan')->where('id', '=', $oxy_id)->delete();
        $deleteControl = DB::table('control')->where('id', '=', $id)->delete();

        if ($deletePumpIn && $deletePumpOut && $deleteOxy && $deleteLamp) {
            Session::flash('success', 'Xóa bộ điều khiển thành công!');
        } else {
            Session::flash('error', 'Xóa bộ điều khiển thất bại!');
        }
        return redirect('control');
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
