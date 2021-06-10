<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Device_Lamp;
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

    public function on_off(Request $request)
    {
        $dl = Device_Lamp::create([
            "control" => $request->get("control"),
            "description" => $request->get("description"),
            "created_at" => $request->get("created_at"),
        ]);
        return \response()->json($dl, 200);
    }
}