<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Control;
use App\Models\Lamp;
use App\Models\Oxygen_fan;
use App\Models\Pond;
use App\Models\Pump_In;
use App\Models\Pump_out;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ConfigControlController extends Controller
{
    public function showView()
    {
        $controlSingup = DB::select('SELECT ponds.id as IDPond, ponds.id_user as IDUser, control.`id`,ponds.`name` as name_pond, control.`name` as name_control, control.address
          FROM ponds, control
          WHERE control.id_pond = ponds.id and control.active = 0');

        $controls = DB::select('SELECT ponds.id as IDPond, ponds.id_user as IDUser, control.`id`,ponds.`name` as name_pond, ponds.active as activePond, control.`name` as name_control, control.address, control.active as activeControl, pump_in.`status` as pump_in, pump_out.`status` as pump_out, lamp.`status` as lamp, oxygen_fan.`status` as oxygen_fan
          FROM ponds, control, pump_in, pump_out, lamp, oxygen_fan
          WHERE control.id_pond = ponds.id and control.id_pump_in = pump_in.id and control.id_pump_out = pump_out.id and control.id_lamp = lamp.id and control.id_oxygen_fan = oxygen_fan.id');
        return view('controls.viewUser')->with([
            'controlSingup' => $controlSingup,
            'controls' => $controls,
        ]);
    }

    public function showControl($id)
    {
        $control = Control::find($id);
        $control_pumpIn = Control::find($id)->pumpIns;
        $control_pumpOut = Control::find($id)->pumpOut;
        $control_lamp = Control::find($id)->lamps;
        $control_oxygen = Control::find($id)->oxygen;
        return response()->json([$control, $control_pumpIn, $control_pumpOut, $control_lamp, $control_oxygen]);
    }

    public function showSingup()
    {
        $controls_create = Pond::where('id_user', '=', session('UserID'))->get();
        return view('controls.singup', compact('controls_create'));
    }

    public function postSingup(Request $request)
    {
        $request->validate([
            'nameControl' => 'required',
            'addControl' => 'required',
            'pondID' => 'required',
        ], $this->messages());
        $c = Control::where('id_pond', '=', $request->pondID)
            ->where('name', '=', $request->nameControl)->first();
        if ($c == null) {
            Control::create([
                'id_pond' => $request->pondID,
                'name' => $request->nameControl,
                'address' => $request->addControl,
                'active' => 0,
            ]);
            return redirect()->back()->withInput($request->only('ok'))->withErrors(['singupControl' => '????ng k?? th??m b??? ??i???u khi???n th??nh c??ng - Vui l??ng ch??? h??? th???ng ki???m duy???t!']);
        } else
            return redirect()->back()->withErrors(['nameControl' => 'T??n b??? ??i???u khi???n n??y ???? t???n t???i!']);
    }

    public function updateInfo($id)
    {
        $pondall = Pond::all();
        $controlId = Control::all()->where('id', $id)->first();
        $pondId = Pond::all()->where('id', $controlId->id_pond)->first();
        $pumpInId = Pump_In::all()->where('id', $controlId->id_pump_in)->first();
        $pumpOutId = Pump_out::all()->where('id', $controlId->id_pump_out)->first();
        $lampId = Lamp::all()->where('id', $controlId->id_lamp)->first();
        $oxygenId = Oxygen_fan::all()->where('id', $controlId->id_oxygen_fan)->first();
        return view('controls.update',['pondall' => $pondall, 'controlId' => $controlId, 'pondId' => $pondId, 'pumpInId' => $pumpInId, 'pumpOutId' => $pumpOutId, 'lampId' => $lampId, 'oxygenId' => $oxygenId]);
    }

    public function postUpdateInfo(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'upAcControl' => 'required',
            'id_pond' => 'required',
            'control_pumpIn' => 'required',
            'control_pumpOut' => 'required',
            'control_lamp' => 'required',
            'control_oxy' => 'required',
        ], $this->messages());

        $c = Control::where('id_pond', '=', $request->id_pond)
            ->where('name', '=', $request->name)->first();
        if ($c == null || $c->id == $id) {
            $quest = Control::find($id);
            $quest->id_pond = $request->id_pond;
            $quest->name = $request->name;
            $quest->update_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');

            $pumpIn_id = $quest->id_pump_in;
            $pumpOut_id = $quest->id_pump_out;
            $lamp_id = $quest->id_lamp;
            $oxy_id = $quest->id_oxygen_fan;

            if ($quest->active == 1 && $request->upAcControl == 2) {
                $pumpIn = Pump_In::find($pumpIn_id);
                $pumpIn->status = 0;
                $pumpIn->timer_on = null;
                $pumpIn->timer_off = null;
                $pumpIn->update();

                $pumpOut = Pump_out::find($pumpOut_id);
                $pumpOut->status = 0;
                $pumpOut->timer_on = null;
                $pumpOut->timer_off = null;
                $pumpOut->update();

                $lamp = Lamp::find($lamp_id);
                $lamp->status = 0;
                $lamp->timer_on = null;
                $lamp->timer_off = null;
                $lamp->update();

                $oxy = Oxygen_fan::find($oxy_id);
                $oxy->status = 0;
                $oxy->timer_on = null;
                $oxy->timer_off = null;
                $oxy->update();

                $quest->active = $request->upAcControl;
                $quest->update();
                return redirect()->back()->withInput($request->only('ok'))->withErrors(['submit_updateControll' => 'Ch???nh s???a b??? ??i???u khi???n th??nh c??ng!']);
            } else {
                if ($quest->active == 2 && $request->upAcControl == 2) {
                    return redirect()->back()->withErrors(['upAcControl' => 'Kh??ng th??? c???p nh???t th??ng tin khi b??? ??i???u khi???n ??ang b??? kh??a!']);
                } else {
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

                    $quest->active = $request->upAcControl;
                    $quest->update();
                    return redirect()->back()->withInput($request->only('ok'))->withErrors(['submit_updateControll' => 'Ch???nh s???a b??? ??i???u khi???n th??nh c??ng!']);
                }
            }
        } else
            return redirect()->back()->withErrors(['name' => 'T??n b??? ??i???u khi???n n??y ???? t???n t???i!']);
    }


    public function deleteControl($id)
    {
        $quest = Control::find($id);
        if ($quest->active == 0) {
            $quest->delete();
            Session::flash('success', 'X??a b??? ??i???u khi???n th??nh c??ng!');
        } else {
            $quest->active = 3;
            $quest->delete_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            if ($quest->update()) {
                Session::flash('success', 'X??a b??? ??i???u khi???n th??nh c??ng!');
            } else {
                Session::flash('error', 'X??a b??? ??i???u khi???n th???t b???i!');
            }
        }
        return redirect()->route('configControl');
    }


    private function messages()
    {
        return [
            'nameControl.required' => 'B???n c???n nh???p t??n b??? ??i???u khi???n',
            'name.required' => 'B???n c???n nh???p t??n b??? ??i???u khi???n',
            'addControl.required' => 'B???n c???n nh???p v??? tr?? l???p b??? ??i???u khi???n.',
            'pondID.required' => 'B???n c???n ch???n ao s??? h???u.',
            'id_pond.required' => 'B???n c???n ch???n ao s??? h???u.',
            'upAcControl.required' => 'B???n c???n ch???n tr???ng th??i b??? ??i???u khi???n.',
            'control_pumpIn.required' => 'B???n c???n ch???n tr???ng th??i ho???t ?????ng.',
            'control_pumpOut.required' => 'B???n c???n ch???n tr???ng th??i ho???t ?????ng.',
            'control_lamp.required' => 'B???n c???n ch???n tr???ng th??i ho???t ?????ng.',
            'control_oxy.required' => 'B???n c???n ch???n tr???ng th??i ho???t ?????ng.',
        ];
    }
}
