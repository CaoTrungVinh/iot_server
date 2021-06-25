<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/19/2021
 * Time: 10:31 AM
 */

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Warning_Temp;
use App\Notifications\WarningTemp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Response;
use App\Models\Temperature;
use NotificationChannels\Fcm\FcmChannel;

class TemperatureController extends Controller
{
    public function store(Request $request)
    {
    $warning = Warning_Temp::all()->last();
    $id_warning = $warning->id;
    $ds = Temperature::create([
        "id_warning" => $id_warning,
        "temperature" => $request->get("temperature"),
        "created_at" => $request->get("created_at"),
    ]);
    $teamp = $request->get("temperature"); Log::info("$teamp");
    if($teamp<=$warning->temperature_min||$teamp>=$warning->temperature_max){
        $user = new User();
        $user->notify(new WarningTemp("Cảnh báo","Nhiệt độ hiện tại đang ở mức không an toàn"));
    }
    return \response()->json($ds, 200);
    }


    public function getdata()
    {
        $ds18 = Temperature::all();
        return \response()->json($ds18, 200);
    }

    public function gettemplast()
    {
        $ds18 = Temperature::all()->last();
        $abc = $ds18->temperature;
        return \response()->json($abc, 200);
    }

    public function temp_safe()
    {
        $ds18 = Warning_Temp::all()->last();
        $abc = $ds18->temperature_min . '-' . $ds18->temperature_max;
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