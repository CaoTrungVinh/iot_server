<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Control;
use App\Models\Pond;
use App\Models\Toolkit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexUserController extends Controller
{
    public function indexUser()
    {
        $sum_Tool = 0;
        $sum_Control = 0;

        $count_Pond = Pond::where('id_user', '=', session('UserID'))
            ->where('active', '!=', 3)->count();

        $listPond = Pond::where('id_user', '=', session('UserID'))
            ->where('active', '!=', 3)->get();

        foreach ($listPond as $lp){
            $count_Tool = Toolkit::where('id_pond', '=', $lp->id)
                ->where('active', '!=', 0)->count();

            $count_Control = Control::where('id_pond', '=', $lp->id)
                ->where('active', '!=', 0)->count();

            $sum_Control += $count_Control;
            $sum_Tool += $count_Tool;
        }

        $getPond = Pond::withCount('toolkits')->withCount('controls')
            ->where('id_user', '=', session('UserID'))
            ->where('active', '!=', 3)->get();

        return view('pages.homeUser')->with([
            'count_Pond' => $count_Pond,
            'sum_Tool' => $sum_Tool,
            'sum_Control' => $sum_Control,
            'getPond' => $getPond,
        ]);
    }
}
