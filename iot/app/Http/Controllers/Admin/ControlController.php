<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/11/2021
 * Time: 2:52 PM
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ControlController extends Controller
{
    public function index()
    {
        $controls = DB::select('SELECT ponds.`name` as name_pond, control.`name` as name_control, control.address, pump_in.`status` as pump_in, pump_out.`status` as pump_out, lamp.`status` as lamp, oxygen_fan.`status` as oxygen_fan
          FROM ponds, control, pump_in, pump_out, lamp, oxygen_fan
          WHERE control.id_pond = ponds.id and control.id_pump_in = pump_in.id and control.id_pump_out = pump_out.id and control.id_lamp = lamp.id and control.id_oxygen_fan = oxygen_fan.id');
        return view('controls.index', compact('controls'));
    }
    public function store()
    {
        return view('controls.store');
    }
    public function edit()
    {
        return view('controls.edit');
    }
}