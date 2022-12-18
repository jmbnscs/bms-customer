<?php
// Declare Main DIR
if (!defined("DIR_API")) define("DIR_API", "https://api.gstechbms.online/api/");

// Inititiate curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

return $ch;