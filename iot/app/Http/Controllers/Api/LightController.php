<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Models\Light;

class LightController extends Controller
{
    public function store(Request $request)
    {
        $nv = Light::create([
            "light" => $request->get("light"),
            "description" => $request->get("description"),
            "created_at" => $request->get("created_at"),
            "updated_at" => $request->get("updated_at")
        ]);
        return \response()->json($nv, 200);
    }
    public function getdata()
    {
        $nvz = Light::all();
        return \response()->json($nvz, 200);
    }
    public function getlightlast()
    {
        $nvz = Light::all()->last();
        $abc = $nvz->light;
        return \response()->json($abc, 200);
    }
}