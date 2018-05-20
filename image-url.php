<?php
ini_set('display_errors', 'On');
//error_reporting(-1);
error_reporting(0);

require_once("Way2enjoyweb.php");



// database connection starts here   
date_default_timezone_set("Asia/Kolkata"); 
include('/home/something/public_html/somefolder/connecti.php');
mysqli_set_charset($con, 'utf8mb4');
$random_table_way2enjoy = array(array('table' => 'table1', 'column'=>'image_column_for_table1','anything_else'=>'ignore_this1'),
           array('table' => 'table2', 'column' => 'image_column_for_table2','anything_else'=>'ignore_this2'),
          array('table' => 'table3', 'column' => 'image_column_for_table3','anything_else'=>'ignore_this3'),
);

$num_way2enjoy = array_rand($random_table_way2enjoy);
$item_random_way2enjoy = $random_table_way2enjoy[$num_way2enjoy];



$re7 = mysqli_query($con,"select id,status,$item_random_way2enjoy['column'] from $item_random_way2enjoy['table'] where status='0' order by id desc limit 1");
$row2 = mysqli_fetch_assoc($re7);
$status=$row2['status'];
$iddd=$row2['id'];
$imglink=$row2['prod_img'];
$imglink_absolute='http://www.sitename.com/images/'.$row2['prod_img'];
$image_path='/home/something/public_html/somefolder/'.$imglink;
// database connection ends here




$Way2web = new Way2enjoyweb("your@email.com", "websitename");

$params = array(
    "url" => $imglink_absolute,
    "wait" => true,
//varies from 32-320//    "mp3_bit" => "96",
//varies from 1-100//    "quality" => "95",
//	"resize" => array(
//        "width" => 100,
//        "height" => 75,
//        "strategy" => "crop"
	 ),
);

$data = $Way2web->url($params);
//echo $params["url"];
//var_dump($url);

if (!empty($data["success"])) {

	copy($data["compressed_url"], $image_path);
	
	mysqli_query($con,"update $random_table set status='1' where id='$iddd' ");	
	
	// optimization succeeded
	echo "Success. Optimized image URL: " . $data["compressed_url"];

} elseif (isset($data["message"])) {

	// something went wrong with the optimization
	echo "Optimization failed. Error message from Way2enjoy.com: " . $data["message"];
} else {

	// something went wrong with the request
	echo "cURL request failed. Error message: " . $data["error"];
}
