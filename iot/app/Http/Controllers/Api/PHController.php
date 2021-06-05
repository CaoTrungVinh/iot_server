<?php

namespace App\Http\Controllers\Api;

use App\Models\PH;
use App\Models\Warning_Ph;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class PHController extends Controller
{
    public function store(Request $request)
    {
        $ph = PH::create([
            "value" => $request->get("value"),
            "created_at" => $request->get("created_at"),
            "updated_at" => $request->get("updated_at")
        ]);
        return \response()->json($ph, 200);
    }
    public function getdata()
    {
        $ph = PH::all();
        return \response()->json($ph, 200);
    }

    public function getphlast()
    {
        $ph = PH::all()->last();
        $abc = $ph->value;
        return \response()->json($abc, 200);
    }
    public function ph_safe()
    {
        $ph = Warning_Ph::all()->last();
        $abc = $ph->ph_min. '-' .$ph->ph_max;
        return \response()->json($abc, 200);
    }
    public function warning_ph(Request $request)
    {
        $warning = Warning_Ph::create([
            "ph_min" => $request->get("ph_min"),
            "ph_max" => $request->get("ph_max")
        ]);
        return \response()->json($warning, 200);
    }
}