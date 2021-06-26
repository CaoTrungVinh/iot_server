<?php

namespace App\Http\Controllers\Api;

use App\Models\PH;
use App\Models\User;
use App\Models\Warning_Ph;
use App\Notifications\WarningTemp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class PHController extends Controller
{
    public function store(Request $request)
    {
        $warning = Warning_Ph::all()->last();
        $id_warning = $warning->id;

        $ph = PH::create([
            "id_warning" => $id_warning,
            "value" => $request->get("value"),
            "created_at" => $request->get("created_at"),
            "updated_at" => $request->get("updated_at")
        ]);
        $phs = $request->get("value"); Log::info("$phs");
        if ($warning->warning_id == 1){
            if($phs<=$warning->ph_min||$phs>=$warning->ph_max){
                $user = new User();
                $user->notify(new WarningTemp("Cảnh báo độ Ph","Độ Ph trong ao nuôi vượt mức an toàn"));
            }
        }
        return \response()->json($ph, 200);
    }

    public function set_warning(Request $request)
    {
        $warning =Warning_Ph::all()->last();
        $warning_id = $warning->id;
        $warning_onoff =Warning_Ph::find($warning_id);
        $warning_onoff->update($request->all());
        return \response()->json($warning_onoff, 200);
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
        $warning =Warning_Ph::all()->last();
        $warning_id = $warning->warning_id;
        $warning = Warning_Ph::create([
            "ph_min" => $request->get("ph_min"),
            "ph_max" => $request->get("ph_max"),
            "warning_id" => $warning_id
        ]);
        return \response()->json($warning, 200);
    }
}