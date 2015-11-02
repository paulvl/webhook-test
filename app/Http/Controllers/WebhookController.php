<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WebhookController extends Controller
{
    public function getWebhook()
    {
        $basePath = base_path();
        \Log::info("se llego a webook");

        $cmd1 = 'git -C ' . $basePath . ' add -A';
        $cmd2 = 'git -C ' . $basePath . ' commit -m "changes 3"';
        $cmd3 = 'git -C ' . $basePath . ' push -u origin master';

        exec($cmd1);
        exec($cmd2);
        exec($cmd3);

        return 1121;
    }
    
    public function postWebhook(Request $request)
    {
        $all = $request->all();
        $keys = array_keys($all);
        \Log::info("valores que llegaron con el hook!!!");  
        foreach ($keys as $key) {
            \Log::info($key . ': '. $all[$key]);            
        }
        $basePath = base_path();
        $cmd = 'git -C ' . $basePath . ' pull';
        exec($cmd);

        return 'correcto';
        
    }
}
