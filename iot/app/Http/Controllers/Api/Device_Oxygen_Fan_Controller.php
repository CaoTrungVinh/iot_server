<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/7/2021
 * Time: 12:11 PM
 */

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Device_Oxygen_fan;
use App\Models\Timer_Device_Oxygen_Fan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
class Device_Oxygen_Fan_Controller  extends Controller
{
    public function get_oxygen_fan()
    {
        $dpi = Device_Oxygen_fan::all()->last();
        $abc = $dpi->control;
        return \response()->json($abc, 200);
    }

    public function on_off(Request $request)
    {
        $dpi = Device_Oxygen_fan::create([
            "control" => $request->get("control"),
            "description" => $request->get("description"),
            "created_at" => $request->get("created_at"),
        ]);
        return \response()->json($dpi, 200);
    }

    public function timer_on_off(Request $request)
    {
        $dof = Device_Oxygen_fan::create([
            "control" => $request->get("control"),
            "description" => $request->get("description"),
            "created_at" => $request->get("created_at"),
        ]);
        $tof = Timer_Device_Oxygen_Fan::create([
            "id_oxygen_fan" => $dof->id,
            "timer_on" => $request->get("timer_on"),
            "timer_off" => $request->get("timer_off"),
        ]);
        return \response()->json([$dof,$tof], 200);
    }
}