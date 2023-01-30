<?php
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
        $url = "https://";   
else  
        $url = "http://";   

$url.= $_SERVER['HTTP_HOST'];   

// $url.= $_SERVER['REQUEST_URI'];  
$url.= "/betaapi/api/";  
    
// Declare Main DIR
if (!defined("DIR_API")) define("DIR_API", $url);

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

return $ch;