<?php
// Declare Main DIR
if (!defined("DIR_API")) define("DIR_API", "https://bms.gstechbms.online/gstech_api/api/");

// Inititiate curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

return $ch;