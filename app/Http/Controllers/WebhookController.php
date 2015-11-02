<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WebhookController extends Controller
{
    public function getWebhook()
    {
        \Log::info("se llego a webook");
        return 1;
    }
    
    public function postWebhook(Request $request)
    {
        $all = $request->all();
        $keys = array_keys($all);
        \Log::info("valores que llegaron con el hook!!!");  
        foreach ($keys as $key) {
            \Log::info($key . ': '. $all[$key]);            
        }
        return 'correcto';
    }
}
