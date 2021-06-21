<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DHT11;


class DHT11Controller extends Controller
{
    public function index(){
        $data = DHT11::all();
        return view('pages.dht11', compact('data'));
    }
    public function view($id){
        return view('pages.edit');
    }
}
