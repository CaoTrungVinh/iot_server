<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Device_Lamp;
use App\Models\Timer_Device_Lamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
class Device_Lamp_Controller extends Controller
{
    public function get_lamp()
    {
        $dl = Device_Lamp::all()->last();
        $abc = $dl->control;
        return \response()->json($abc, 200);
    }

    public function timer_lamp_on_off()
    {
        $dpo = Device_Lamp::all()->last();
        $device = $dpo->control;

        $tof = Timer_Device_Lamp::all()->last();
        $timer = $tof->timer_on. '#' .$tof->timer_off;
        return \response()->json([$device,$timer], 200);
    }

    public function on_off(Request $request)
    {
        $dl = Device_Lamp::create([
            "control" => $request->get("control"),
            "description" => $request->get("description"),
            "created_at" => $request->get("created_at"),
        ]);
        return \response()->json($dl, 200);
    }

    public function timer_on_off(Request $request)
    {
        $dl = Device_Lamp::create([
            "control" => $request->get("control"),
            "description" => $request->get("description"),
            "created_at" => $request->get("created_at"),
        ]);
        $tof = Timer_Device_Lamp::create([
            "id_lamp" => $dl->id,
            "timer_on" => $request->get("timer_on"),
            "timer_off" => $request->get("timer_off"),
        ]);
        return \response()->json([$dl,$tof], 200);
    }
}