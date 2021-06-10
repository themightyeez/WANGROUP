<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Router;
use App\Ping;
use App\RouterOSAPI;
use Log;

class MonitoringController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function browse(){
        $devices = Router::all();
        return view('monitoring', compact('devices'));
    }

    public function edit(Request $req){
        $router = Router::find($req->get('id'));
        if (!$router) {
            return redirect()->action('MonitoringController@browse')->with('toast_error','Data Invalid!');
        }
        
        $router->identity = $req->get('identity');
        $router->location = $req->get('location');
        $router->save();

        return redirect()->action('MonitoringController@browse')->with('toast_success','Data Updated!');
    }

    public function pingExec(Request $req) {
        $router = Router::find($req->get('id'));
        
        $latency = false;
    
        $exec_string = 'ping -n -c 10 '.$router->ip_address.' 2>&1';
    
        exec($exec_string, $output, $return);
    
        $commandOutput = implode('', $output);
        $output = array_values(array_filter($output));
    
        if (!empty($output[1])) {
          $response = preg_match("/time(?:=|<)(?<time>[\.0-9]+)(?:|\s)ms/", $output[1], $matches);
    
          if ($response > 0 && isset($matches['time'])) {
            $latency = round($matches['time'], 4);
          }
        }

        $router->status = $latency;
        $router->save();
    
        return response()->json(['status' => 'completed', 'result' => $latency]);
      }
      
}
