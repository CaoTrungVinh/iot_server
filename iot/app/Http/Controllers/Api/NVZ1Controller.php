<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Models\NVZ1;

class NVZ1Controller extends Controller
{
    public function store(Request $request)
    {
        $nv = NVZ1::create([
            "light" => $request->get("light"),
            "description" => $request->get("description"),
            "created_at" => $request->get("created_at"),
            "updated_at" => $request->get("updated_at")
        ]);
        return \response()->json($nv, 200);
    }
    public function getdata()
    {
        $nvz = NVZ1::all();
        return \response()->json($nvz, 200);
    }
    public function getlightlast()
    {
        $nvz = NVZ1::all()->last();
        $abc = $nvz->light;
        return \response()->json($abc, 200);
    }
}