<?php
// Always start with here..

// Fetch POST Data from JS
$sample = $_POST['sample'];

$ch = require "init_curl.php";
// .. to here

// For Create APIs
$url = DIR_API . "api_folder/create.php";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($_POST));

// For Read APIs
$url = DIR_API . "api_folder/read.php";

curl_setopt($ch, CURLOPT_URL, $url);

// For Update APIs
$url = DIR_API . "api_folder/update.php";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($_POST));

// For Delete APIs
$url = DIR_API . "api_folder/delete.php";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($_POST));

// Curl Execution
$resp = curl_exec($ch);

$status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

if ($e = curl_error($ch))
{
    echo $e;
}
else
{
    $data = json_decode($resp, true);

    // code here

    // Note: Whatever you echo here would be returned to js (like echo = return)
    // *Always return data in json format

    // If no existing json to be returned, create one
    // echo json_encode(
    //     array (
    //         'message' => 'failed'
    //     )
    // );

    // If json data is available
    // echo json_encode(
    //     $json_data_var
    // );
}

// Always close curl
curl_close($ch);