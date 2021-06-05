<?php

namespace App\Http\Controllers\Api;

use App\Models\DHT11;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class DHT11Controller extends Controller
{
    public function index()
    {
        $DHT11 = DHT11::all();
        return \response()->json($DHT11, 200);
    }

    public function store(Request $request)
    {
        $dh = DHT11::create([
            "humi" => $request->get("humi"),
            "temp" => $request->get("temp")
        ]);
        return \response()->json($dh, 200);
    }
}
