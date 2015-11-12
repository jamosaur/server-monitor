<?php namespace App\Http\Controllers;
class ServerController extends Controller {

    static $data;

    static $status;

    static $url;

    public static function getServerStatus()
    {
        //ServerHelper::connect($ip, $port);
        //echo '<pre>';print_r(\App\Http\Controllers\ServerController::$data);echo '</pre>';
        if (\App\Http\Controllers\ServerController::$data == 'error') {
            \App\Http\Controllers\ServerController::$status = 'danger';
        } elseif (\App\Http\Controllers\ServerController::$data == '404') {
            \App\Http\Controllers\ServerController::$status = 'warning';
        } else {
            \App\Http\Controllers\ServerController::$status = 'success';
        }
        return ServerHelper::$status;
    }

    public static function connect($ip, $port = '80')
    {
        \App\Http\Controllers\ServerController::$url = $ip.':'.($port == null ? '80' : $port);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, \App\Http\Controllers\ServerController::$url.'/ss.php');
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
        $response = curl_exec($ch);
        //echo curl_error($ch);

        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == '200') {
            \App\Http\Controllers\ServerController::$data = $response;
        } elseif (curl_getinfo($ch, CURLINFO_HTTP_CODE) == '404' || curl_getinfo($ch, CURLINFO_HTTP_CODE) == '301') {
            \App\Http\Controllers\ServerController::$data = '404';
        } else {
            \App\Http\Controllers\ServerController::$data = 'error';
        }
        curl_close($ch);
    }

    public function getServerData()
    {
        $servers = \App\Server::all();
        return view('server.list', array(
            'servers' => $servers
        ));
    }

    public function getServerInfo($ip, $port = 80)
    {
        $ch = curl_init();
        if ($port == 80 || $port == null) {
            $url = str_replace('~~', '/~', $ip);
        } else {
            $url = $ip.':'.($port == null ? '80' : $port);
        }
        curl_setopt($ch, CURLOPT_URL, $url.'/ss.php');
        //curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
        $response = curl_exec($ch);

        $array = array();

        $notFoundBar = '<div class="progress progress-striped active">
                              <div class="progress-bar progress-bar-danger"  role="progressbar" style="width: 100%">
                                Not Found
                              </div>
                            </div>';
        $downBar = '<div class="progress progress-striped active">
                              <div class="progress-bar"  role="progressbar" style="width: 100%">
                                Down
                              </div>
                            </div>';

        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == '200' || curl_getinfo($ch, CURLINFO_HTTP_CODE) == '301') {
            $win = json_decode($response, true);
            $win['status'] = 'success';
            return json_encode($win);

        } elseif (curl_getinfo($ch, CURLINFO_HTTP_CODE) == '404') {
            $array['status'] = 'warning';
            $array['uptime'] = $notFoundBar;
            $array['load'] = $notFoundBar;
            $array['memory'] = $notFoundBar;
            $array['disk'] = $notFoundBar;
        } else {
            $array['status'] = 'danger';
            $array['uptime'] = $downBar;
            $array['load'] = $downBar;
            $array['memory'] = $downBar;
            $array['disk'] = $downBar;
        }
        return json_encode($array);
    }

}






