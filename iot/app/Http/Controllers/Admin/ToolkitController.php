<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/11/2021
 * Time: 2:52 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Light;
use App\Models\PH;
use App\Models\Pond;
use App\Models\Temperature;
use App\Models\Toolkit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ToolkitController extends Controller
{
    public function index()
    {
        $toolkits = DB::select('SELECT toolkits.`id`,ponds.`name` as name_pond, toolkits.`name` as name_toolkit, toolkits.address, temperatures.temperature, temperatures.temperature_min,temperatures.temperature_max, phs.`value`, lights.light
          FROM toolkits, ponds, temperatures, phs, lights
          WHERE toolkits.id_pond = ponds.id and toolkits.id_temperature = temperatures.id and toolkits.id_ph = phs.id and toolkits.id_light = lights.id');
        return view('toolkits.index', compact('toolkits'));
    }

    public function create()
    {
        $toolkit_create = Pond::all();
        return view('toolkits.store', compact('toolkit_create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'id_pond' => 'required',
            'temperature_min' => 'required',
            'temperature_max' => 'required',
            'warning_temp' => 'required',
            'ph_min' => 'required',
            'ph_max' => 'required',
            'warning_ph' => 'required',
            'warning_light' => 'required',
        ], $this->messages());

        $temperature = Temperature::create([
            "temperature" => 0,
            "temperature_min" => $request->get("temperature_min"),
            "temperature_max" => $request->get("temperature_max"),
            "warning" => $request->get("warning_temp"),
        ]);
        $ph = PH::create([
            "value" => 0,
            "ph_min" => $request->get("ph_min"),
            "ph_max" => $request->get("ph_max"),
            "warning" => $request->get("warning_ph"),
        ]);
        $light = Light::create([
            "light" => 0,
            "warning" => $request->get("warning_light"),
        ]);
        $temp_id = $temperature->id;
        $ph_id = $ph->id;
        $light_id = $light->id;

        $toolkit = Toolkit::create([
            "id_pond" => $request->get("id_pond"),
            "id_temperature" => $temp_id,
            "id_ph" => $ph_id,
            "id_light" => $light_id,
            "name" => $request->get("name"),
            "address" => $request->get("address"),
        ]);

        if ($toolkit) {
            Session::flash('success', 'Thêm mới bộ đo thành công!');
        } else {
            Session::flash('error', 'Thêm bộ đo thất bại!');
        }
        return redirect('toolkit');
    }

    public function edit($id)
    {
        $pondall = Pond::all();
        $toolkitId = Toolkit::all()->where('id', $id)->first();
        $pondId = Pond::all()->where('id', $toolkitId->id_pond)->first();
        $tempId = Temperature::all()->where('id', $toolkitId->id_temperature)->first();
        $phId = PH::all()->where('id', $toolkitId->id_ph)->first();
        $lightId = Light::all()->where('id', $toolkitId->id_light)->first();

        return view('toolkits.edit', ['pondall' => $pondall, 'toolkitId' => $toolkitId, 'pondId' => $pondId, 'tempId' => $tempId, 'phId' => $phId, 'lightId' => $lightId]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'id_pond' => 'required',
            'temperature' => 'required',
            'temperature_min' => 'required',
            'temperature_max' => 'required',
            'warning_temp' => 'required',
            'ph' => 'required',
            'ph_min' => 'required',
            'ph_max' => 'required',
            'warning_ph' => 'required',
            'warning_light' => 'required',
        ], $this->messages());

        $toolkit = DB::table('toolkits')->where('id', $request->id)->update([
            'id_pond' => $request->id_pond,
            'name' => $request->name,
            'address' => $request->address,
        ]);
        $quest = Toolkit::all()->where('id', $request->id)->first();
        $temp_id = $quest->id_temperature;
        $ph_id = $quest->id_ph;
        $light_id = $quest->id_light;

        $temp = DB::table('temperatures')->where('id', $temp_id)->update([
            "temperature" => $request->get("temperature"),
            "temperature_min" => $request->get("temperature_min"),
            "temperature_max" => $request->get("temperature_max"),
            "warning" => $request->get("warning_temp"),
        ]);
        $ph = DB::table('phs')->where('id', $ph_id)->update([
            "value" => $request->get("ph"),
            "ph_min" => $request->get("ph_min"),
            "ph_max" => $request->get("ph_max"),
            "warning" => $request->get("warning_ph"),
        ]);
        $light = DB::table('lights')->where('id', $light_id)->update([
            "light" => $request->get("light"),
            "warning" => $request->get("warning_light"),
        ]);
        if ($toolkit || $temp || $ph &&$light) {
            Session::flash('success', 'Chỉnh sửa bộ đo thành công!');
        } else {
            Session::flash('error', 'Chỉnh sửa bộ đo thất bại!');
        }
        return redirect('toolkit');
    }

    public function delete($id)
    {
        $quest = Toolkit::all()->where('id', $id)->first();
        $temp_id = $quest->id_temperature;
        $ph_id = $quest->id_ph;
        $light_id = $quest->id_light;

        $deleteTemp = DB::table('temperatures')->where('id', '=', $temp_id)->delete();
        $deletePh = DB::table('phs')->where('id', '=', $ph_id)->delete();
        $deleteLight = DB::table('lights')->where('id', '=', $light_id)->delete();
        $deleteToolkit = DB::table('toolkits')->where('id', '=', $id)->delete();

        if ($deleteTemp && $deletePh && $deleteLight) {
            Session::flash('success', 'Xóa bộ đo thành công!');
        } else {
            Session::flash('error', 'Xóa bộ đo thất bại!');
        }
        return redirect('toolkit');
    }
    private function messages()
    {
        return [
            'name.required' => 'Bạn cần nhập tên bộ đo',
            'address.required' => 'Bạn cần nhập nơi để bộ đo.',
            'id_pond.required' => 'Bạn cần chọn ao sở hữu.',
            'temperature.required' => 'Bạn cần chọn nhiệt độ.',
            'temperature_min.required' => 'Bạn cần chọn nhiệt độ nhỏ nhất.',
            'temperature_max.required' => 'Bạn cần chọn nhiệt độ lớn nhất.',
            'ph.required' => 'Bạn cần chọn độ Ph.',
            'ph_min.required' => 'Bạn cần chọn độ Ph nhỏ nhất.',
            'ph_max.required' => 'Bạn cần chọn độ Ph lớn nhất.',
            'warning_temp.required' => 'Bạn cần thiết lập cảnh bảo.',
            'warning_ph.required' => 'Bạn cần thiết lập cảnh bảo.',
            'warning_light.required' => 'Bạn cần thiết lập cảnh bảo.',
        ];
    }
}