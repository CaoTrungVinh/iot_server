<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;

class DeviceController extends Controller
{
    public function getdata()
    {
        $device = Device::all()->last();
        $abc = $device->pumpIn.$device->pumpOut.$device->motor.$device->lamp;
        return \response()->json($abc, 200);
    }
}