<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$url = $_POST['url'];
// $url = "https://www.yell.com/ucs/UcsSearchAction.do?scrambleSeed=985844398&keywords=webdesign&location=Birmingham";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
$html = curl_exec($ch);
curl_close($ch);

$pokemon_doc = new DOMDocument();

libxml_use_internal_errors(TRUE); //disable libxml errors

if(!empty($html)){ //if any html is actually returned

	$pokemon_doc->loadHTML($html);
	libxml_clear_errors(); //remove errors for yucky html

	$pokemon_xpath = new DOMXPath($pokemon_doc);

	$pokemon_row = $pokemon_xpath->query('//span[@class="businessCapsule--name"]');

	// $pokemon_row1 = $pokemon_xpath->query('//div[@class="business--multiplePhonesWrapper"]')->item(0);
	// print_r($pokemon_row1);
	// die();
	
	$pokemon_row2 = $pokemon_xpath->query('//span[@itemprop="address"]');

	// $phones = array();
	$all_address = array();
	$agency_names = array();

	$list = array(
		// $phones,
		$all_address,
		$agency_names
	);

if($pokemon_row2->length > 0){
		foreach($pokemon_row2 as $row){
			array_push($all_address, $row->nodeValue);
			//echo $row->nodeValue . "<br/>";
		}
	}

	// if($pokemon_row1->length > 0){
	// 	foreach($pokemon_row1 as $row){
	// 		array_push($phones, $row->nodeValue);
	// 		//echo $row->nodeValue . "<br/>";
	// 	}
	// }

	if($pokemon_row->length > 0){
		foreach($pokemon_row as $row){
			array_push($agency_names, $row->nodeValue);
			//echo $row->nodeValue . "<br/>";
		}
	}
}
$_SESSION["agency_names"] = $agency_names;
$_SESSION["all_address"] = $all_address;
// $_SESSION["phones"] = $phones;


// print_r($_SESSION["name"]);
header('Location: index.php');
// set session variable and return command to index page


// $list = array (
//     $agency_names, 
//     $phones,
//     $all_address
// );

// $fp = fopen('scrapper.csv', 'a+');

// foreach ($list as $fields) {
//    fputcsv($fp, $fields);
// }

// fclose($fp);
?>