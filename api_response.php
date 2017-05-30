<?php

$base = 'http://lowkeymahasiswa.hol.es/';

$uri = 'https://api.instagram.com/oauth/access_token';
$data = [
    'client_id' => '025173b2073942ce899a6012ccb821ff',
    'client_secret' => 'a30417aa85dc43039c567b27cce9155d',
    'grant_type' => 'authorization_code',
    'redirect_uri' => $base.'api_response.php',
    'code' => $_GET['code']
];

/*=======================================================================================================
||  - Initiate curl
||  - Parse URI for instagram access token
||  - Specify the POST method
||  - Specify the fields and values
||  - Recieve return results true
||  - Disable header because we don't need that
||  - Disable nobody since that will send us nothing and we need a response which is the ACCESS TOKEN
||  - This has something to do with SSL and i don't understand that
||  - This too
||=======================================================================================================
*/

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $uri);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$result = json_decode(curl_exec($curl));    // This will return object
// $result = curl_exec($curl);                 This will return only string

session_start();
$_SESSION['access_token'] = $result->access_token;

header('Location: http://lowkeymahasiswa.hol.es/insta_leaderboard.php');