<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/19/2021
 * Time: 10:31 AM
 */

namespace App\Http\Controllers\Api;

use App\Models\Warning_Temp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Models\DS18B20;

class DS18B20Controller extends Controller
{
    public function store(Request $request)
    {
        $ds = DS18B20::create([
            "temperature" => $request->get("temperature")
        ]);
        return \response()->json($ds, 200);
    }
    public function getdata()
    {
        $ds18 = DS18B20::all();
        return \response()->json($ds18, 200);
    }
    public function gettemplast()
    {
        $ds18 = DS18B20::all()->last();
        $abc = $ds18->temperature;
        return \response()->json($abc, 200);
    }
    public function temp_safe()
    {
        $ds18 = Warning_Temp::all()->last();
        $abc = $ds18->temperature_min. '-' .$ds18->temperature_max;
        return \response()->json($abc, 200);
    }
    public function warning_temp(Request $request)
    {
        $warning = Warning_Temp::create([
            "temperature_min" => $request->get("temperature_min"),
            "temperature_max" => $request->get("temperature_max")
        ]);
        return \response()->json($warning, 200);
    }
}