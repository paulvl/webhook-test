<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WebhookController extends Controller
{
    public function getIndex(Request $request)
    {
        return "OK 12312312312scsddsfsfdfd";
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

        $secret = 'caca11';
 
        $headers = getallheaders();
        $hubSignature = $headers['X-Hub-Signature'];
         
        // Split signature into algorithm and hash
        list($algo, $hash) = explode('=', $hubSignature, 2);
         
        // Get payload
        $payload = file_get_contents('php://input');
         
        // Calculate hash based on payload and the secret
        $payloadHash = hash_hmac($algo, $payload, $secret);
         
        // Check if hashes are equivalent
        if ($hash !== $payloadHash) {
            // Kill the script or do something else here.
            die('Bad secret');
        }

        \Log::info('hash: '. $hash);

        $all = $request->all();
        $keys = array_keys($all);
       
        $basePath = base_path();

        $command = 'git -C ' . $basePath . ' pull origin master';

        \Log::info("======");
        /*
        $commands = array(
            'echo $PWD',
            'whoami',
            $cmx . ' pull origin master',
            $cmx . ' status',
            $cmx . ' submodule sync',
            $cmx . ' submodule update',
            $cmx . ' submodule status',
        );*/

        /*
        foreach ($keys as $key) {
            \Log::info($key . ': '. $all[$key]);            
        }
        */
        $output = shell_exec($command);
        \Log::info($output);

        return 'correcto';

    }
}
