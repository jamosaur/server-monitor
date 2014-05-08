<?php

class ServerHelper {
    
    static $data;
    
    static $status;
    
    static $url;
    
    public static function getServerStatus()
    {
        //ServerHelper::connect($ip, $port);
        //echo '<pre>';print_r(ServerHelper::$data);echo '</pre>';
        if (ServerHelper::$data == 'error') {
            ServerHelper::$status = 'danger';
        } elseif (ServerHelper::$data == '404') {
            ServerHelper::$status = 'warning';
        } else {
            ServerHelper::$status = 'success';
        }
        return ServerHelper::$status;
    }
    
    public static function connect($ip, $port = '80')
    {
        ServerHelper::$url = $ip.':'.($port == null ? '80' : $port);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, ServerHelper::$url.'/ss.php');
        curl_setopt($ch, CURLOPT_HEADER, 1); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
        $response = curl_exec($ch);
        //echo curl_error($ch);
        
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == '200') {
            ServerHelper::$data = $response;
        } elseif (curl_getinfo($ch, CURLINFO_HTTP_CODE) == '404' || curl_getinfo($ch, CURLINFO_HTTP_CODE) == '301') {
             ServerHelper::$data = '404';
        } else {
            ServerHelper::$data = 'error';
        }
        curl_close($ch);
    }
    
}