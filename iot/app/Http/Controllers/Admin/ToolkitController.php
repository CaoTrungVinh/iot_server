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

class ToolkitController extends Controller
{
    public function index()
    {
        $toolkits = DB::select('SELECT ponds.`name` as name_pond, toolkits.`name` as name_toolkit, toolkits.address, temperatures.temperature, temperatures.temperature_min,temperatures.temperature_max, phs.`value`, lights.light
          FROM toolkits, ponds, temperatures, phs, lights
          WHERE toolkits.id_pond = ponds.id and toolkits.id_temperature = temperatures.id and toolkits.id_ph = phs.id and toolkits.id_light = lights.id');
        return view('toolkits.index', compact('toolkits'));
    }
    public function store()
    {
        return view('toolkits.store');
    }
    public function edit()
    {
        return view('toolkits.edit');
    }
}