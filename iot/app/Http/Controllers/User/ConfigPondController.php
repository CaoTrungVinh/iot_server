<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Control;
use App\Models\ControlDelete;
use App\Models\Light;
use App\Models\PH;
use App\Models\Pond;
use App\Models\PondDelete;
use App\Models\Temperature;
use App\Models\Toolkit;
use App\Models\ToolkitDelete;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ConfigPondController extends Controller
{
    public function showPond(){
        $pondUser = Pond::withCount('toolkits')->withCount('controls')
            ->where('id_user', '=', session('UserID'))->get();
       return view('ponds.pondUser', ['pondUser'=>$pondUser]);
    }

    public function showSingup()
    {
        return view('ponds.singup');
    }

//
    public function doSingup(Request $request)
    {
        $request->validate([
            'namePond' => 'required',
            'addressPond' => 'required',
        ], $this->messages());

        $pond = Pond::where('name', '=', $request->namePond)->first();
        if ($pond == null) {
            Pond::create([
                'id_user' => Session::get('User')->id,
                'name' => $request->namePond,
                'address' => $request->addressPond,
//                're_countToolkit' => $request->singupToolkit,
//                're_countControl' => $request->singupControl,
                'active' => 1,
                'created_date' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
            ]);
            return redirect()->back()->withInput($request->only('singupPond'))->withErrors(['singupPond' => 'Tạo ao thông tin nuôi thành công!']);
        } else {
            return redirect()->back()->withErrors(['namePond' => 'Tên ao nuôi này đã tồn tại!']);
        }
    }


    public function showViewEdit($id)
    {
        $getDataId = Pond::find($id);
        return view('ponds.config', ['getDataId' => $getDataId]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'edit_namePond' => 'required',
            'edit_addressPond' => 'required',
        ], $this->messages());
        $pond = Pond::where('name', '=', $request->edit_namePond)->first();
        if ($pond == null || $pond->id == $id) {
            $p = Pond::find($id);
            $p->name = $request->edit_namePond;
            $p->address = $request->edit_addressPond;
            $p->update_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            if ($p->active == 0){
                if($request->editToolkit>=1 && $request->editControl >= 0){
                    $p->re_countToolkit = $request->editToolkit;
                    $p->re_countControl = $request->editControl;
                    $p->update();
                    return redirect()->back()->withInput($request->only('submit_editPond'))->withErrors(['submit_editPond' => 'Cập nhật thông tin ao nuôi thành công!']);
                }else{
                    return redirect()->back()->withErrors(['editToolkit' => 'Bạn cần phải đăng ký ít nhất 1 bộ đo và không được để trống.', 'editControl' => 'Không chấp nhận giá trị âm và không được để trống.', 'submit_editPond' => 'Cập nhật ao nuôi thất bại - Giá trị 1 trong 2 trường này không đúng yêu cầu hãy xem lại!']);
                }
            }else{
                if($p->active == 1 && $request->edit_activePond == 2){
                    $toolkit_IDPond = Toolkit::where('id_pond', '=', $id)->get();
                    foreach ($toolkit_IDPond as $toolkit){
                        if($toolkit->active!=0) {
                            $ph = PH::find($toolkit->id_ph);
                            $ph->value = null;
                            $ph->ph_min = null;
                            $ph->ph_max = null;
                            $ph->warning = 0;
                            $ph->update();

                            $nd = Temperature::find($toolkit->id_temperature);
                            $nd->temperature = null;
                            $nd->temperature_min = null;
                            $nd->temperature_max = null;
                            $nd->warning = 0;
                            $nd->update();

                            $as = Light::find($toolkit->id_light);
                            $as->light = null;
                            $as->description = null;
                            $as->warning = 0;
                            $as->update();

                            $toolkit->active = 2;
                            $toolkit->update();
                        }else{
                            $toolkit->delete();
                        }
                    }
                }
                $p->active = $request->edit_activePond;
                $p->update();
                return redirect()->back()->withInput($request->only('submit_editPond'))->withErrors(['submit_editPond' => 'Cập nhật thông tin ao nuôi thành công!']);
            }
        }else{
            return redirect()->back()->withErrors(['edit_namePond' => 'Tên ao nuôi này đã tồn tại!']);
        }
    }

    public function delete($id)
    {
        $deletePond = Pond::find($id);

        $deletePond->active = 3;
        $deletePond->delete_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
//        PondDelete::insert( [
//        'id'      => $deletePond->id,
//        'id_user'   => $deletePond->id_user,
//        'name' => $deletePond->name,
//        'address' => $deletePond->address,
//        're_countToolkit' => $deletePond->re_countToolkit,
//        're_countControl' => $deletePond->re_countControl,
//        'active' => $deletePond->active,
//        'delete_date'   => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s')
//    ] );

        $toolkit_IDPond = Toolkit::where('id_pond', '=', $id)->get();
        foreach ($toolkit_IDPond as $toolkit) {
            $toolkit->active = 3;
            $toolkit->delete_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $toolkit->update();
//            ToolkitDelete::insert([
//                'id' => $toolkit->id,
//                'id_pond' => $toolkit->id_pond,
//                'id_temperature' => $toolkit->id_temperature,
//                'id_ph' => $toolkit->id_ph,
//                'id_light' => $toolkit->id_light,
//                'name' => $toolkit->name,
//                'address' => $toolkit->address,
//                'delete_date' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s')
//            ]);
        }

        $control_IDPond = Control::where('id_pond', '=', $id)->get();
        foreach ($control_IDPond as $control) {
            $control->active = 3;
            $control->delete_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $control->update();
        }
//            ControlDelete::insert([
//                'id' => $control->id,
//                'name' => $control->name,
//                'address' => $control->address,
//                'id_pond' => $control->id_pond,
//                'id_pump_in' => $control->id_pump_in,
//                'id_pump_out' => $control->id_pump_out,
//                'id_lamp' => $control->id_lamp,
//                'id_oxygen_fan' => $control->id_oxygen_fan,
//                'delete_date' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s')
//            ]);
//        }
//        $deleteData = DB::table('ponds')->where('id', '=', $id)->delete();
        if ($deletePond->update()) {
            Session::flash('success', 'Xóa ao nuôi thành công!');
        } else {
            Session::flash('error', 'Xóa ao nuôi thất bại!');
        }
        return redirect()->route('pondConfig');
    }

    private function messages()
    {
        return [
            'namePond.required' => 'Bạn cần nhập tên ao nuôi',
            'addressPond.required' => 'Bạn cần nhập địa chỉ ao nuôi.',
            'edit_namePond.required' => 'Bạn cần nhập tên ao nuôi',
            'edit_addressPond.required' => 'Bạn cần nhập địa chỉ ao nuôi.',
        ];
    }
}
