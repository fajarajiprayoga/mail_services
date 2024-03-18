<?php

namespace App\Http\Controllers;

use App\Jobs\BroadcastSPLValueJob;
use Illuminate\Http\Request;

class SPLController extends Controller
{
    public function broadcastSPLValue(){

        $data = [
            [
                'jam' => '1 jam',
                'value' => '14.000'
            ],
            [
                'jam' => '2 jam',
                'value' => '28.000'
            ]
        ];

        dispatch(new BroadcastSPLValueJob('fajar@gmail.com', 'Fajar', $data));
        
        dd("Hello World");
    }
}
