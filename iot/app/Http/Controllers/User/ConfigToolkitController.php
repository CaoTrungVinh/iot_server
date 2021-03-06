<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Light;
use App\Models\PH;
use App\Models\Pond;
use App\Models\Temperature;
use App\Models\Toolkit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ConfigToolkitController extends Controller
{
    public function showView()
    {
        $toolSingup = DB::select('SELECT ponds.id_user as idUser, ponds.`name` as name_pond, ponds.id as idPond, ponds.active as acivePond, toolkits.`id`, toolkits.`name` as name_toolkit, toolkits.address, toolkits.active
FROM toolkits, ponds
WHERE toolkits.id_pond = ponds.id AND toolkits.active= 0');

        $toolkits = DB::select('SELECT ponds.id_user as idUser, ponds.`name` as name_pond, ponds.id as idPond, ponds.active as acivePond, toolkits.`id`, toolkits.`name` as name_toolkit, toolkits.address, toolkits.active, temperatures.temperature, phs.`value`, lights.light
FROM toolkits, ponds, temperatures, phs, lights
WHERE toolkits.id_pond = ponds.id AND toolkits.id_ph = phs.id AND toolkits.id_light = lights.id AND toolkits.id_temperature = temperatures.id');
        return view('toolkits.viewUser')->with([
            'toolSingup' => $toolSingup,
            'toolkits' => $toolkits,
        ]);
    }

    public function showToolkit($id)
    {
//        $user = [User::find($id)];
        $toolkit = Toolkit::find($id);
        $toolkit_PH = Toolkit::find($id)->phs;
        $toolkit_ND = Toolkit::find($id)->temperatures;
        $toolkit_AS = Toolkit::find($id)->lights;
        return response()->json([$toolkit, $toolkit_PH, $toolkit_ND, $toolkit_AS]);
    }

    public function showSingup()
    {
        $toolkit_create = Pond::where('id_user', '=', session('UserID'))->get();
        return view('toolkits.singup', compact('toolkit_create'));
    }

    public function postSingup(Request $request)
    {
        $request->validate([
            'nameToolkit' => 'required',
            'addressToolkit' => 'required',
            'IDPond' => 'required',
        ], $this->messages());
        $t = Toolkit::where('id_pond', '=', $request->IDPond)
            ->where('name', '=', $request->nameToolkit)->first();
        if ($t == null) {
            Toolkit::create([
                'id_pond' => $request->IDPond,
                'name' => $request->nameToolkit,
                'address' => $request->addressToolkit,
                'active' => 0,
            ]);
            return redirect()->back()->withInput($request->only('ok'))->withErrors(['singupTool' => '????ng k?? th??m b??? ??o th??nh c??ng - Vui l??ng ch??? h??? th???ng ki???m duy???t!']);
        } else
            return redirect()->back()->withErrors(['nameToolkit' => 'T??n b??? ??o n??y ???? t???n t???i!']);
    }

    public function updateInfo($id)
    {
        $pondall = Pond::all();
        $toolkitId = Toolkit::all()->where('id', $id)->first();
        $pondId = Pond::all()->where('id', $toolkitId->id_pond)->first();
        $tempId = Temperature::all()->where('id', $toolkitId->id_temperature)->first();
        $phId = PH::all()->where('id', $toolkitId->id_ph)->first();
        $lightId = Light::all()->where('id', $toolkitId->id_light)->first();

        return view('toolkits.update', ['pondall' => $pondall, 'toolkitId' => $toolkitId, 'pondId' => $pondId, 'tempId' => $tempId, 'phId' => $phId, 'lightId' => $lightId]);
    }


    public function postUpdateInfo(Request $request, $id)
    {
        $request->validate([
            'upNameTool' => 'required',
            'upAcTool' => 'required',
            'upIDPondTool' => 'required',
            'temperature_min' => 'required',
            'temperature_max' => 'required',
            'warning_temp' => 'required',
            'ph_min' => 'required',
            'ph_max' => 'required',
            'warning_ph' => 'required',
            'warning_light' => 'required',
        ], $this->messages());

        $t = Toolkit::where('id_pond', '=', $request->upIDPondTool)
            ->where('name', '=', $request->upNameTool)->first();
        if ($t == null || $t->id == $id) {
            $quest = Toolkit::find($id);
            $quest->id_pond = $request->upIDPondTool;
            $quest->name = $request->upNameTool;
            $quest->update_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');

            $temp_id = $quest->id_temperature;
            $ph_id = $quest->id_ph;
            $light_id = $quest->id_light;

            if ($quest->active == 1 && $request->upAcTool == 2) {
                $temp = Temperature::find($temp_id);
                $temp->temperature = 0;
                $temp->temperature_min = 0;
                $temp->temperature_max = 0;
                $temp->warning = 0;
                $temp->update();

                $ph = PH::find($ph_id);
                $ph->value = 0;
                $ph->ph_min = 0;
                $ph->ph_max = 0;
                $ph->warning = 0;
                $ph->update();

                $light = Light::find($light_id);
                $light->light = 0;
                $light->warning = 0;
                $light->update();

                $quest->active = $request->upAcTool;
                $quest->update();
                return redirect()->back()->withInput($request->only('ok'))->withErrors(['submit_updateTool' => 'Ch???nh s???a b??? ??o th??nh c??ng!']);
            } else {
                if ($quest->active == 2 && $request->upAcTool == 2) {
                    return redirect()->back()->withErrors(['upAcTool' => 'Kh??ng th??? c???p nh???t th??ng tin khi b??? ??o b??? kh??a!']);
                } else {
                    $temp = DB::table('temperatures')->where('id', $temp_id)->update([
                        "temperature_min" => $request->get("temperature_min"),
                        "temperature_max" => $request->get("temperature_max"),
                        "warning" => $request->get("warning_temp"),
                    ]);
                    $ph = DB::table('phs')->where('id', $ph_id)->update([
                        "ph_min" => $request->get("ph_min"),
                        "ph_max" => $request->get("ph_max"),
                        "warning" => $request->get("warning_ph"),
                    ]);
                    $light = DB::table('lights')->where('id', $light_id)->update([
                        "warning" => $request->get("warning_light"),
                    ]);

                    $quest->active = $request->upAcTool;
                    $quest->update();
                    return redirect()->back()->withInput($request->only('ok'))->withErrors(['submit_updateTool' => 'Ch???nh s???a b??? ??o th??nh c??ng!']);
                }
            }
        } else
            return redirect()->back()->withErrors(['upNameTool' => 'T??n b??? ??o n??y ???? t???n t???i!']);
    }

    public function deleteTool($id)
    {
        $quest = Toolkit::find($id);
        if ($quest->active == 0) {
            $quest->delete();
            Session::flash('success', 'X??a b??? ??o th??nh c??ng!');
        } else {
            $quest->active = 3;
            $quest->delete_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            if ($quest->update()) {
                Session::flash('success', 'X??a b??? ??o th??nh c??ng!');
            } else {
                Session::flash('error', 'X??a b??? ??o th???t b???i!');
            }
        }
        return redirect()->route('configToolkit');
    }

    private function messages()
    {
        return [
            'nameToolkit.required' => 'B???n c???n nh???p t??n b??? ??o',
            'addressToolkit.required' => 'B???n c???n nh???p n??i ????? b??? ??o.',
            'IDPond.required' => 'B???n c???n ch???n ao s??? h???u.',
            'upNameTool.required' => 'B???n c???n ch???n nhi???t ?????.',
            'upAcTool.required' => 'B???n c???n ch???n nhi???t ?????.',
            'upIDPondTool.required' => 'B???n c???n ch???n nhi???t ?????.',
            'temperature_min.required' => 'B???n c???n ch???n nhi???t ????? nh??? nh???t.',
            'temperature_max.required' => 'B???n c???n ch???n nhi???t ????? l???n nh???t.',
            'ph_min.required' => 'B???n c???n ch???n ????? Ph nh??? nh???t.',
            'ph_max.required' => 'B???n c???n ch???n ????? Ph l???n nh???t.',
            'warning_temp.required' => 'B???n c???n thi???t l???p c???nh b???o.',
            'warning_ph.required' => 'B???n c???n thi???t l???p c???nh b???o.',
            'warning_light.required' => 'B???n c???n thi???t l???p c???nh b???o.',
        ];
    }
}
