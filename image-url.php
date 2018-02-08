<?php
ini_set('display_errors', 'On');
//error_reporting(-1);
error_reporting(0);

require_once("Way2enjoyweb.php");

$Way2web = new Way2enjoyweb("your@email.com", "websitename");

$params = array(
    "url" => "http://i2.wp.com/images.indianexpress.com/2017/06/india-pakistan-759.jpg",
    "wait" => true,
//varies from 32-320//    "mp3_bit" => "96",
//varies from 1-100//    "quality" => "95",
//	"resize" => array(
//        "width" => 100,
//        "height" => 75,
//        "strategy" => "crop"
);

$data = $Way2web->url($params);
//echo $params["url"];
//var_dump($url);

if (!empty($data["success"])) {

	// optimization succeeded
//	echo "Success. Optimized image URL: " . $data["kraked_url"];
	echo "Success. Optimized image URL: " . $data["compressed_url"];

} elseif (isset($data["message"])) {

	// something went wrong with the optimization
	echo "Optimization failed. Error message from Way2enjoy.com: " . $data["message"];
} else {

	// something went wrong with the request
	echo "cURL request failed. Error message: " . $data["error"];
}