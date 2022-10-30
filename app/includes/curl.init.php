<?php
// Declare Main DIR
if (!defined("DIR_API")) define("DIR_API", "http://localhost/gstech_api/api/");

// Inititiate curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

return $ch;