<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/2/2021
 * Time: 4:42 PM
 */

namespace App\Http\Controllers\Api;

use App\Models\Control;
use App\Models\Lamp;
use App\Models\Light;
use App\Models\Oxygen_fan;
use App\Models\PH;
use App\Models\Pond;
use App\Models\Pump_In;
use App\Models\Pump_out;
use App\Models\Temperature;
use App\Models\Token_FCM;
use App\Models\Toolkit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use NotificationChannels\Fcm\FcmChannel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use App\Notifications\WarningTemp;

class PondController extends Controller
{
    public function pond(Request $request)
    {
        $pond = Pond::where('id_user', '=', $request->get("user"))->get();
//        return \response()->json(['pond'=>$pond], 200);
        return \response()->json($pond, 200);
    }

    public function toolkit(Request $request)
    {
        $pond = Toolkit::where('id_pond', '=', $request->get("pond"))->get();
        return \response()->json($pond, 200);
    }

    public function control(Request $request)
    {
        $pond = Control::where('id_pond', '=', $request->get("pond"))->get();
        return \response()->json($pond, 200);
    }

    public function temperature(Request $request)
    {
        $pond = Temperature::where('id', '=', $request->get("id"))->get();
        return \response()->json($pond, 200);
    }

    public function light(Request $request)
    {
        $pond = Light::where('id', '=', $request->get("id"))->get();
        return \response()->json($pond, 200);
    }

    public function ph(Request $request)
    {
        $pond = PH::where('id', '=', $request->get("id"))->get();
        return \response()->json($pond, 200);
    }

    public function setWarningTemp(Request $request)
    {
        $pond = DB::table('temperatures')
            ->where('id', $request->get("id"))
            ->update(['temperature_min' => $request->get("temperature_min"),
                'temperature_max' => $request->get("temperature_max")]);
        return \response()->json($pond, 200);
    }

    public function setWarningPh(Request $request)
    {
        $pond = DB::table('phs')
            ->where('id', $request->get("id"))
            ->update(['ph_min' => $request->get("ph_min"),
                'ph_max' => $request->get("ph_max")]);
        return \response()->json($pond, 200);
    }

    public function setWarningTemp_onoff(Request $request)
    {
        $pond = DB::table('temperatures')
            ->where('id', $request->get("id"))
            ->update(['warning' => $request->get("warning")]);
        return \response()->json($pond, 200);
    }

    public function setWarningPh_onoff(Request $request)
    {
        $pond = DB::table('phs')
            ->where('id', $request->get("id"))
            ->update(['warning' => $request->get("warning")]);
        return \response()->json($pond, 200);
    }

    public function setWarningLight_onoff(Request $request)
    {
        $pond = DB::table('lights')
            ->where('id', $request->get("id"))
            ->update(['warning' => $request->get("warning")]);
        return \response()->json($pond, 200);
    }

    public function pump_in(Request $request)
    {
        $pond = Pump_In::where('id', '=', $request->get("id"))->get();
        return \response()->json($pond, 200);
    }

    public function setPumpIn_onoff(Request $request)
    {
        $pond = DB::table('pump_in')
            ->where('id', $request->get("id"))
            ->update(['status' => $request->get("status")]);
        return \response()->json($pond, 200);
    }

    public function set_timer_pump_in(Request $request)
    {
        $pond = DB::table('pump_in')
            ->where('id', $request->get("id"))
            ->update(['status' => 2,
                'timer_on' => $request->get("timer_on"),
                'timer_off' => $request->get("timer_off")]);
        return \response()->json($pond, 200);
    }

    public function pump_out(Request $request)
    {
        $pond = Pump_out::where('id', '=', $request->get("id"))->get();
        return \response()->json($pond, 200);
    }

    public function setPumpOut_onoff(Request $request)
    {
        $pond = DB::table('pump_out')
            ->where('id', $request->get("id"))
            ->update(['status' => $request->get("status")]);
        return \response()->json($pond, 200);
    }

    public function set_timer_pump_out(Request $request)
    {
        $pond = DB::table('pump_out')
            ->where('id', $request->get("id"))
            ->update([
                'status' => 2,
                'timer_on' => $request->get("timer_on"),
                'timer_off' => $request->get("timer_off")]);
        return \response()->json($pond, 200);
    }

    public function lamp(Request $request)
    {
        $pond = Lamp::where('id', '=', $request->get("id"))->get();
        return \response()->json($pond, 200);
    }

    public function setLamp_onoff(Request $request)
    {
        $pond = DB::table('lamp')
            ->where('id', $request->get("id"))
            ->update(['status' => $request->get("status")]);
        return \response()->json($pond, 200);
    }

    public function set_timer_lamp(Request $request)
    {
        $pond = DB::table('lamp')
            ->where('id', $request->get("id"))
            ->update(['status' => 2,
                'timer_on' => $request->get("timer_on"),
                'timer_off' => $request->get("timer_off")]);
        return \response()->json($pond, 200);
    }

    public function oxygen_fan(Request $request)
    {
        $pond = Oxygen_fan::where('id', '=', $request->get("id"))->get();
        return \response()->json($pond, 200);
    }

    public function setOxygen_fan_onoff(Request $request)
    {
        $pond = DB::table('oxygen_fan')
            ->where('id', $request->get("id"))
            ->update(['status' => $request->get("status")]);
        return \response()->json($pond, 200);
    }

    public function set_timer_oxygen_fan(Request $request)
    {
        $pond = DB::table('oxygen_fan')
            ->where('id', $request->get("id"))
            ->update(['status' => 2,
                'timer_on' => $request->get("timer_on"),
                'timer_off' => $request->get("timer_off")]);
        return \response()->json($pond, 200);
    }


    ///fcm
    public function token_fcm(Request $request)
    {
        $fcm = Token_FCM::create([
            "id_user" => $request->get("id_user"),
            "token_fcm" => $request->get("token_fcm"),
        ]);
        return \response()->json($fcm, 200);
    }

    public function delete_fcm(Request $request)
    {
        $fcm = Token_FCM::where('token_fcm', $request->get("token_fcm"))->first();
        if ($fcm != '[]') {
            $article = Token_FCM::findOrFail($fcm->id);
            $article->delete();
            return \response()->json($article, 200);
        } elseif ($fcm == '[]') {
            return \response()->json($fcm, 200);
        }
    }

    /// client
    public function server_temp(Request $request)
    {
        $update_temp = DB::table('temperatures')
            ->where('id', $request->get("id"))
            ->update([
                'temperature' => $request->get("temperature"),
                'created_at' => $request->get("created_at"),]);

        $temp = $request->get("temperature");
        Log::info("$temp");

        $tempquery = Temperature::where('id', $request->get("id"))->first();
        $warning = $tempquery->warning;
        $temp_min = $tempquery->temperature_min;
        $temp_max = $tempquery->temperature_max;

        $toolkit = Toolkit::where('id_temperature', '=', $request->get("id"))->first();
        $pond = Pond::where('id', '=', $toolkit->id_pond)->first();
        $id_user = $pond->id_user;

        if ($warning == 1) {
            if ($temp <= $temp_min || $temp >= $temp_max) {

                $user = User::find($id_user);
                $user->notify(new WarningTemp("Cảnh báo", "Nhiệt độ ao nuôi $temp*C vượt mức an toàn"));
            }
        }
        return \response()->json($update_temp, 200);
    }

    public function server_ph(Request $request)
    {
        $update_ph = DB::table('phs')
            ->where('id', $request->get("id"))
            ->update([
                'value' => $request->get("value"),
                'created_at' => $request->get("created_at"),
            ]);

        $ph = $request->get("value");
        Log::info("$ph");
        $phquery = PH::where('id', $request->get("id"))->first();
        $warning = $phquery->warning;
        $ph_min = $phquery->ph_min;
        $ph_max = $phquery->ph_max;

        $toolkit = Toolkit::where('id_ph', '=', $request->get("id"))->first();
        $pond = Pond::where('id', '=', $toolkit->id_pond)->first();
        $id_user = $pond->id_user;

        if ($warning == 1) {
            if ($ph <= $ph_min || $ph >= $ph_max) {
                $user = User::find($id_user);
                $user->notify(new WarningTemp("Cảnh báo", "Độ Ph ao nuôi $ph vượt mức an toàn"));
            }
        }
        return \response()->json($update_ph, 200);
    }

    public function server_light(Request $request)
    {
        $update_light = DB::table('lights')
            ->where('id', $request->get("id"))
            ->update([
                'light' => $request->get("light"),
                'description' => $request->get("description"),
                'created_at' => $request->get("created_at"),
            ]);

        $light = $request->get("light");
        Log::info("$light");

        $warning = DB::table('lights')->where('id', $request->get("id"))->value('warning');

        $toolkit = Toolkit::where('id_light', '=', $request->get("id"))->first();
        $pond = Pond::where('id', '=', $toolkit->id_pond)->first();
        $id_user = $pond->id_user;

        if ($warning == 1) {
            if ($light == 1) {
                $user = User::find($id_user);
                $user->notify(new WarningTemp("Cảnh báo", "Ao nuôi trời tối nguy hiểm"));
            }
        }
        return \response()->json($update_light, 200);
    }


    public function activetoolkit(Request $request)
    {
        $toolkit = Toolkit::find($request->id);
        if ($toolkit != null) {
            if ($toolkit->active == 4) {
                if ($request->key == $toolkit->key_active) {
                    $toolkit->active = 1;
                    $toolkit->dateLap = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
                    $toolkit->update();
                }
                return \response()->json("Kich hoat thanh cong", 200);
            }
        }
    }

    // Bộ đo
    public function setDataTemp(Request $request)
    {
        $toolkit = Toolkit::find($request->id);
        $id_temp = $toolkit->id_temperature;

        if ($toolkit->active == 1) {
            $update_temp = DB::table('temperatures')
                ->where('id', $id_temp)
                ->update([
                    'temperature' => $request->get("temperature"),
                    'created_at' => $request->get("created_at"),]);

            $temp = $request->get("temperature");

            $pond = Pond::where('id', '=', $toolkit->id_pond)->first();
            $id_user = $pond->id_user;

            $auto_tem = Temperature::find($id_temp);
            if ($auto_tem->auto_control == 1) {
                if ($temp > $auto_tem->temperature_max || $temp < $auto_tem->temperature_min) {
                    $control_pond = Control::where('id_pond', '=', $toolkit->id_pond)->get();
                    foreach ($control_pond as $controlList) {
                        if ($controlList->active == 1) {
                            $oxygenControl = Oxygen_fan::where('id', '=', $controlList->id_oxygen_fan)->first();
                            if ($oxygenControl->status != 1)
                                $oxygenControl->status = 1;
                            $oxygenControl->update();
                        }
                    }
                } else {
                    $c_pond = Control::where('id_pond', '=', $toolkit->id_pond)->get();
                    foreach ($c_pond as $controlList) {
                        if ($controlList->active == 1) {
                            $oxy = Oxygen_fan::where('id', '=', $controlList->id_oxygen_fan)->first();
                            $oxy->status = 0;
                            $oxy->update();
                        }
                    }
                }
            }

            Log::info("$temp");

            $tempquery = Temperature::where('id', $id_temp)->first();
            $warning = $tempquery->warning;
            $temp_min = $tempquery->temperature_min;
            $temp_max = $tempquery->temperature_max;

            if ($warning == 1) {
                if ($temp <= $temp_min || $temp >= $temp_max) {
                    $user = User::find($id_user);
                    $user->notify(new WarningTemp("Cảnh báo", "Nhiệt độ ao nuôi $temp*C vượt mức an toàn"));
                }
            }
        } else {
            return \response()->json("Error", 200);
        }
        return \response()->json($id_temp, 200);
    }

    public function setDataPh(Request $request)
    {
        $toolkit = Toolkit::find($request->id);
        $id_ph = $toolkit->id_ph;

        if ($toolkit->active == 1) {
            $update_ph = DB::table('phs')
                ->where('id', $id_ph)
                ->update([
                    'value' => $request->get("value"),
                    'created_at' => $request->get("created_at"),
                ]);

            $ph = $request->get("value");
            Log::info("$ph");
            $phquery = PH::where('id', $id_ph)->first();
            $warning = $phquery->warning;
            $ph_min = $phquery->ph_min;
            $ph_max = $phquery->ph_max;

            $pond = Pond::where('id', '=', $toolkit->id_pond)->first();
            $id_user = $pond->id_user;

            $auto_pHs = PH::find($id_ph);
            if ($auto_pHs->auto_control == 1) {
                if ($ph > $auto_pHs->ph_max || $ph < $auto_pHs->ph_min) {
                    $control_pond = Control::where('id_pond', '=', $toolkit->id_pond)->get();
                    foreach ($control_pond as $controlList) {
                        if ($controlList->active == 1) {
                            $pumInControl = Pump_In::where('id', '=', $controlList->id_pump_in)->first();
                            if ($pumInControl->status == 1) {
                                $pumInControl->status = 0;
                            } else {
                                $pumInControl->status = 1;
                            }
                            $pumInControl->update();

                            $pumOutControl = Pump_out::where('id', '=', $controlList->id_pump_out)->first();
                            if ($pumOutControl->status != 1) {
                                $pumOutControl->status = 1;
                                $pumOutControl->update();
                            }
                        }
                    }
                } else {
                    $control_pond = Control::where('id_pond', '=', $toolkit->id_pond)->get();
                    foreach ($control_pond as $controlList) {
                        if ($controlList->active == 1) {
                            $pumInControl = Pump_In::where('id', '=', $controlList->id_pump_in)->first();
                            $pumInControl->status = 0;
                            $pumInControl->update();

                            $pumOutControl = Pump_out::where('id', '=', $controlList->id_pump_out)->first();
                            $pumOutControl->status = 0;
                            $pumOutControl->update();
                        }
                    }
                }
            }

            if ($warning == 1) {
                if ($ph <= $ph_min || $ph >= $ph_max) {
                    $user = User::find($id_user);
                    $user->notify(new WarningTemp("Cảnh báo", "Độ Ph ao nuôi $ph vượt mức an toàn"));
                }
            }
        } else {
            return \response()->json("Error", 200);
        }

        return \response()->json($id_ph, 200);
    }

    public
    function setDataLight(Request $request)
    {
        $toolkit = Toolkit::find($request->id);
        $id_light = $toolkit->id_light;

        if ($toolkit->active == 1) {
            $update_light = DB::table('lights')
                ->where('id', $id_light)
                ->update([
                    'light' => $request->get("light"),
                    'description' => $request->get("description"),
                    'created_at' => $request->get("created_at"),
                ]);

            $light = $request->get("light");
            Log::info("$light");

            $warning = DB::table('lights')->where('id', $id_light)->value('warning');

            $pond = Pond::where('id', '=', $toolkit->id_pond)->first();
            $id_user = $pond->id_user;

            $auto_Light = Temperature::find($id_light);
            if ($auto_Light->auto_control == 1) {
                $control_pond = Control::where('id_pond', '=', $toolkit->id_pond)->get();
                foreach ($control_pond as $controlList) {
                    if ($controlList->active == 1) {
                        $LampControl = Lamp::where('id', '=', $controlList->id_lamp)->first();
                        if ($light == 1) {
                            if ($LampControl->status != 1) {
                                $LampControl->status = 1;
                                $LampControl->update();
                            }
                        }
                        if ($light == 0) {
                            if ($LampControl->status != 0) {
                                $LampControl->status = 0;
                                $LampControl->update();
                            }
                        }
                    }
                }
            }

            if ($warning == 1) {
                if ($light == 1) {
                    $user = User::find($id_user);
                    $user->notify(new WarningTemp("Cảnh báo", "Ao nuôi trời tối nguy hiểm"));
                }
            }
        } else {
            return \response()->json("Error", 200);
        }
        return \response()->json($id_light, 200);
    }


// điều khiển
    public
    function activeControl(Request $request)
    {
        $control = Control::find($request->id);
        if ($control != null) {
            if ($control->active == 4) {
                if ($request->key == $control->key_active) {
                    $control->active = 1;
                    $control->date_active = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
                    $control->update();
                }
                return \response()->json("Kich hoat thanh cong", 200);
            }
        }
    }

    public
    function getDataPumpIn(Request $request)
    {
        $control = Control::find($request->id);
        $id_pump = $control->id_pump_in;
        if ($control->active == 1) {
            $pond = Pump_In::where('id', '=', $id_pump)->get();
            return \response()->json($pond, 200);
        } else {
            return \response()->json("Erro", 200);
        }
    }

    public
    function getDataPumpOut(Request $request)
    {
        $control = Control::find($request->id);
        $id_pump = $control->id_pump_out;
        if ($control->active == 1) {
            $pond = Pump_out::where('id', '=', $id_pump)->get();
            return \response()->json($pond, 200);
        } else {
            return \response()->json("Error", 200);
        }
    }

    public
    function getDataLamp(Request $request)
    {
        $control = Control::find($request->id);
        $id_pump = $control->id_lamp;
        if ($control->active == 1) {
            $pond = Lamp::where('id', '=', $id_pump)->get();
            return \response()->json($pond, 200);
        } else {
            return \response()->json("Error", 200);
        }
    }

    public
    function getDataOxygenFan(Request $request)
    {
        $control = Control::find($request->id);
        $id_pump = $control->id_oxygen_fan;
        if ($control->active == 1) {
            $pond = Oxygen_fan::where('id', '=', $id_pump)->get();
            return \response()->json($pond, 200);
        } else {
            return \response()->json("Error", 200);
        }
    }

    public
    function setAutoTemp(Request $request)
    {
        $pond = DB::table('temperatures')
            ->where('id', $request->get("id"))
            ->update(['auto_control' => $request->get("auto_control")]);
        return \response()->json($pond, 200);
    }

    public
    function setAutoPh(Request $request)
    {
        $pond = DB::table('phs')
            ->where('id', $request->get("id"))
            ->update(['auto_control' => $request->get("auto_control")]);
        return \response()->json($pond, 200);
    }

    public
    function setAutoLight(Request $request)
    {
        $pond = DB::table('lights')
            ->where('id', $request->get("id"))
            ->update(['auto_control' => $request->get("auto_control")]);
        return \response()->json($pond, 200);
    }
}
