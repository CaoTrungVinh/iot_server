<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        return view('pages.firebase');
    }

    public function sendNotification()
    {
        $token = "eiE0PHzUitI:APA91bHqOZh5cEfYZwc0PfYbSHcePtCvlY-0AUKxxo49BrXnYtSYGOIHc7fcZ5LG58PHP0zJa2h8Cg21XvfwM5oksvFApAhyppul38q4TQ6wzlRKLCw-lmqaIKNxqcRovYn2RGhlqFTj";
        $from = "AAAAhWPkLns: APA91bHcwuD-B66cG4eRREM6FPr5FN3JWVf9tvWh6U1p2af_ccrW2Fr7QpsRXN_650Y9h8L-zh3htGo8IAQEGh5XVBYKe2hYcnUgFr7QpsRXN_650Y9h8L-zh3htGo8IAQEGh5XVBYKe2hYcnUgRWGYKYKe2hcnUgSKYKRFKZl";
        $msg = array
        (
            'body' => "Testing Testing",
            'title' => "Hi, From Raj",
            'receiver' => 'erw',
            'icon' => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
            'sound' => 'mySound'/*Default sound*/
        );

        $fields = array
        (
            'to' => $token,
            'notification' => $msg
        );

        $headers = array
        (
            'Authorization: key=' . $from,
            'Content-Type: application/json'
        );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        dd($result);
        curl_close($ch);
    }
}
