<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/7/2021
 * Time: 11:35 AM
 */

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Device_PumpOut;
use App\Models\Time_Device_PumpOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class Device_PumpOut_Controller extends Controller
{
    public function get_pump_out()
    {
        $dpo = Device_PumpOut::all()->last();
        $abc = $dpo->control;
        return \response()->json($abc, 200);
    }

    public function timer_pump_out_on_off()
    {
        $dpo = Device_PumpOut::all()->last();
        $device = $dpo->control;

        $tof = Time_Device_PumpOut::all()->last();
        $timer = $tof->timer_on. '#' .$tof->timer_off;
        return \response()->json([$device,$timer], 200);
    }

    public function on_off(Request $request)
    {
        $dpo = Device_PumpOut::create([
            "control" => $request->get("control"),
            "description" => $request->get("description"),
            "created_at" => $request->get("created_at"),
        ]);
        return \response()->json($dpo, 200);
    }

    public function timer_on_off(Request $request)
    {
        $dpo = Device_PumpOut::create([
            "control" => $request->get("control"),
            "description" => $request->get("description"),
            "created_at" => $request->get("created_at"),
        ]);
        $tof = Time_Device_PumpOut::create([
            "id_pump_out" => $dpo->id,
            "timer_on" => $request->get("timer_on"),
            "timer_off" => $request->get("timer_off"),
        ]);
        return \response()->json([$dpo,$tof], 200);
    }
}