<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WebhookController extends Controller
{
    public function getIndex()
    {
        return "yeah 200 OK";
    }

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

    public function getWebhook2()
    {
        $basePath = base_path();

        $cmd1 = 'git -C ' . $basePath . ' pull';

        exec($cmd1, $output);

        \Log::info($output);

        return 1121;
    }
    
    public function postWebhook(Request $request)
    {
        $all = $request->all();
        $keys = array_keys($all);
       
        $basePath = base_path();

        $cmx = 'git -C ' . $basePath;

        \Log::info("======");

        $commands = array(
            'echo $PWD',
            'whoami',
            $cmx . ' pull',
            $cmx . ' status',
            $cmx . ' submodule sync',
            $cmx . ' submodule update',
            $cmx . ' submodule status',
        );

        /*
        foreach ($keys as $key) {
            \Log::info($key . ': '. $all[$key]);            
        }
        */
       foreach($commands AS $command){
            $output = shell_exec($command);
            \Log::info($output);
        }

        return 'correcto';

    }
}
