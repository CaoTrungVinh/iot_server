<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/6/2021
 * Time: 3:45 PM
 */

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Device_PumpIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class Device_PumpIn_Controller extends Controller
{
    public function get_pump_in()
    {
        $dpi = Device_PumpIn::all()->last();
        $abc = $dpi->control;
        return \response()->json($abc, 200);
    }

    public function on_off(Request $request)
    {
        $dpi = Device_PumpIn::create([
            "control" => $request->get("control"),
            "description" => $request->get("description"),
            "created_at" => $request->get("created_at"),
        ]);
        return \response()->json($dpi, 200);
    }

    public function timer_on_off(Request $request)
    {

    }
}