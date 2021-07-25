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
}