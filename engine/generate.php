<?php
$USER_ID = "enviosity";
$client_id = getenv('tw_cl_id');
$secret = getenv('tw_cl_sc');
echo $client_id."lol".$_ENV['tw_cl_id'];

$postdata = http_build_query(
    array(
        'client_id' => $client_id,
        'client_secret' => $secret,
		'grant_type' => 'client_credentials'
    )
);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-Type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);

$context  = stream_context_create($opts);
$result = json_decode(file_get_contents('https://id.twitch.tv/oauth2/token', false, $context));
$user_id = 44390855; //Enviosity
$opts = [
    "http" => [
        "method" => "GET",
        "header" => 'Client-ID: '.$client_id.PHP_EOL.
					'Authorization: Bearer '.$result->access_token.PHP_EOL
    ]
];
$context = stream_context_create($opts);
//74 fills the screen
file_put_contents("../envi.json", file_get_contents("https://api.twitch.tv/helix/videos?user_id=".$user_id."&first=70&sort=time&type=archive", false, $context));