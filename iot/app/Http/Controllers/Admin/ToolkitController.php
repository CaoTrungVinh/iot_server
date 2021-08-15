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
use App\Models\ToolkitDelete;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ToolkitController extends Controller
{
    public function index()
    {
        $toolkits = DB::select('SELECT toolkits.*, ponds.id as idPond, ponds.`name` as name_pond, ponds.active as activePond
FROM toolkits, ponds
WHERE toolkits.id_pond = ponds.id');
        return view('toolkits.index', compact('toolkits'));
    }

    public function showIndexRegisTool(){
        $toolkits = DB::select('SELECT toolkits.*, ponds.id as idPond, ponds.`name` as name_pond, ponds.active as activePond, users.id as idUser, users.`name` as userName, users.phone, users.address as addUser
FROM toolkits, ponds, users
WHERE toolkits.id_pond = ponds.id AND ponds.id_user = users.id AND toolkits.active = 0');
        return view('toolkits.indexRegisTool', compact('toolkits'));
    }

    public function okRegisterTool($id){
        $toolkit = Toolkit::find($id);
        $temperature = Temperature::create([
            "temperature" => 0,
            "temperature_min" => 0,
            "temperature_max" => 0,
            "warning" => 0,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s')
        ]);
        $ph = PH::create([
            "value" => 0,
            "ph_min" => 0,
            "ph_max" => 0,
            "warning" => 0,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s')
        ]);
        $light = Light::create([
            "light" => 0,
            "warning" => 0,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s')
        ]);
        $toolkit->id_temperature = $temperature->id;
        $toolkit->id_ph = $ph->id;
        $toolkit->id_light = $light->id;
        $toolkit->active = 4;
        $toolkit->key_active = Str::random(4);
        $toolkit->create_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        if ($toolkit->update()){
            Session::flash('success', 'Tạo bộ đo thành công');
            return redirect()->route('re_toolkit');
        }else{
            Session::flash('error', 'Tạo bộ đo thất bại!');
            return redirect()->route('re_toolkit');
        }
    }

    public function cancelRegisterTool($id){
        $toolkit = Toolkit::find($id);
        if ($toolkit->delete()){
            Session::flash('success', 'Xóa bộ đo khỏi danh sách đăng ký thành công');
            return redirect()->route('re_toolkit');
        }else{
            Session::flash('error', 'Xóa bộ đo khỏi danh sách đăng ký thất bại!');
            return redirect()->route('re_toolkit');
        }
    }

    public function viewToolkit($id)
    {
//        $user = [User::find($id)];
        $toolkit = Toolkit::find($id);
        $pond = Pond::where('id', '=', $toolkit->id_pond)->first();
        $user = User::where('id', '=', $pond->id_user)->first();
        return response()->json([$toolkit, $pond, $user]);
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
        ], $this->messages());
        $t = Toolkit::where('name', '=', $request->name)
            ->where('id_pond', '=', $request->id_pond)->first();
        if($t==null){
            $temperature = Temperature::create([
                "temperature" => 0,
                "temperature_min" => 0,
                "temperature_max" => 0,
                "warning" => 0,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s')
            ]);
            $ph = PH::create([
                "value" => 0,
                "ph_min" => 0,
                "ph_max" => 0,
                "warning" => 0,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s')
            ]);
            $light = Light::create([
                "light" => 0,
                "warning" => 0,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s')
            ]);
            $toolkit = Toolkit::create([
                "id_pond" => $request->id_pond,
                "id_temperature" => $temperature->id,
                "id_ph" => $ph->id,
                "id_light" => $light->id,
                "name" => $request->name,
                "address" => $request->address,
                'active' => 4,
                'key_active' => Str::random(4),
                'create_date' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s')
            ]);
            if ($toolkit) {
                Session::flash('success', 'Thêm mới bộ đo thành công!');
                return redirect()->route('toolkit');
            } else {
                return redirect()->back()->withInput($request->only('sub_store'))->withErrors(['sub_store' => 'Thêm bộ đo thất bại!']);
            }
        }else{
            return redirect()->back()->withErrors(['name' => 'Tên bộ đo này đã tồn tại!']);
        }
    }

    public function showViewUndo($id){
        $toolkit = Toolkit::find($id);
        $pond = Pond::where('id', '=', $toolkit->id_pond)->first();
        $user = User::where('id', '=', $pond->id_user)->first();
        $pondAll = Pond::all();
        return view('toolkits.edit')->with([
            'toolkit' => $toolkit,
            'pond' => $pond,
            'user' => $user,
            'pondAll' => $pondAll,
        ]);
    }

    public function undoToolkit(Request $request, $id){
        $request->validate([
            'nameTool' => 'required',
            'addressTool' => 'required',
            'id_pondTool' => 'required',
        ], $this->messages());
        $t = Toolkit::where('name', '=', $request->nameTool)
            ->where('id_pond', '=', $request->id_pondTool)->first();
        if($t==null || $t->id == $id){
            $pond = Pond::where('id', '=', $request->id_pondTool)->first();
            if($pond->active != 3) {
                $tool = Toolkit::find($id);
                $tool->name = $request->nameTool;
                $tool->address = $request->addressTool;
                $tool->id_pond = $request->id_pondTool;
                $tool->active = 2;
                $tool->create_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
                $tool->update();
                Session::flash('success', 'Khôi phục bộ đo hoạt động lại bình thường!');
                return redirect()->route('toolkit');
            }else {
                return redirect()->back()->withErrors(['id_pondTool' => 'Ao nuôi trong trạng thái tạm xóa!']);
            }
        }else {
            return redirect()->back()->withErrors(['nameTool' => 'Tên bộ đo này đã tồn tại!']);
        }

    }

//    public function edit($id)
//    {
//        $pondall = Pond::all();
//        $toolkitId = Toolkit::all()->where('id', $id)->first();
//        $pondId = Pond::all()->where('id', $toolkitId->id_pond)->first();
//        $tempId = Temperature::all()->where('id', $toolkitId->id_temperature)->first();
//        $phId = PH::all()->where('id', $toolkitId->id_ph)->first();
//        $lightId = Light::all()->where('id', $toolkitId->id_light)->first();
//
//        return view('toolkits.edit', ['pondall' => $pondall, 'toolkitId' => $toolkitId, 'pondId' => $pondId, 'tempId' => $tempId, 'phId' => $phId, 'lightId' => $lightId]);
//    }

//    public function update(Request $request)
//    {
//        $request->validate([
//            'name' => 'required',
//            'address' => 'required',
//            'id_pond' => 'required',
//            'temperature' => 'required',
//            'temperature_min' => 'required',
//            'temperature_max' => 'required',
//            'warning_temp' => 'required',
//            'ph' => 'required',
//            'ph_min' => 'required',
//            'ph_max' => 'required',
//            'warning_ph' => 'required',
//            'warning_light' => 'required',
//        ], $this->messages());
//
//        $toolkit = DB::table('toolkits')->where('id', $request->id)->update([
//            'id_pond' => $request->id_pond,
//            'name' => $request->name,
//            'address' => $request->address,
//        ]);
//        $quest = Toolkit::all()->where('id', $request->id)->first();
//        $temp_id = $quest->id_temperature;
//        $ph_id = $quest->id_ph;
//        $light_id = $quest->id_light;
//
//        $temp = DB::table('temperatures')->where('id', $temp_id)->update([
//            "temperature" => $request->get("temperature"),
//            "temperature_min" => $request->get("temperature_min"),
//            "temperature_max" => $request->get("temperature_max"),
//            "warning" => $request->get("warning_temp"),
//        ]);
//        $ph = DB::table('phs')->where('id', $ph_id)->update([
//            "value" => $request->get("ph"),
//            "ph_min" => $request->get("ph_min"),
//            "ph_max" => $request->get("ph_max"),
//            "warning" => $request->get("warning_ph"),
//        ]);
//        $light = DB::table('lights')->where('id', $light_id)->update([
//            "light" => $request->get("light"),
//            "warning" => $request->get("warning_light"),
//        ]);
//        if ($toolkit || $temp || $ph || $light) {
//            Session::flash('success', 'Chỉnh sửa bộ đo thành công!');
//        } else {
//            Session::flash('error', 'Chỉnh sửa bộ đo thất bại!');
//        }
//        return redirect('toolkit');
//    }

    public function delete($id)
    {
        $deleteTool = Toolkit::find($id);
            ToolkitDelete::insert([
                'id' => $deleteTool->id,
                'id_pond' => $deleteTool->id_pond,
                'id_temperature' => $deleteTool->id_temperature,
                'id_ph' => $deleteTool->id_ph,
                'id_light' => $deleteTool->id_light,
                'name' => $deleteTool->name,
                'address' => $deleteTool->address,
                'key_active' => $deleteTool->key_active,
                'date_active' => $deleteTool->dateLap,
                'delete_date' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s')
            ]);

        if ($deleteTool->delete()) {
            Session::flash('success', 'Xóa bộ đo thành công!');
        } else {
            Session::flash('error', 'Xóa bộ đo thất bại!');
        }
        return redirect()->route('toolkit');
    }

    private function messages()
    {
        return [
            'name.required' => 'Bạn cần nhập tên bộ đo',
            'address.required' => 'Bạn cần nhập nơi để bộ đo.',
            'id_pond.required' => 'Bạn cần chọn ao sở hữu.',
            'nameTool.required' => 'Bạn cần nhập tên bộ đo',
            'addressTool.required' => 'Bạn cần nhập nơi để bộ đo.',
            'id_pondTool.required' => 'Bạn cần chọn ao sở hữu.',
        ];
    }
}
