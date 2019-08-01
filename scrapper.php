<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//$url="https://www.yell.com/ucs/UcsSearchAction.do?scrambleSeed=985844398&keywords=webdesign&location=Birmingham";
// $url = "https://www.yell.com/ucs/UcsSearchAction.do?keywords=web+design+%26+development&location=Birmingham&scrambleSeed=1525804849&pageNum=".$i;

$url = $_POST['url'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
$html = curl_exec($ch);
curl_close($ch);
//$html = file_get_contents('http://pokemondb.net/evolution'); //get the html returned from the following url


// print_r($html);
$pokemon_doc = new DOMDocument();

libxml_use_internal_errors(TRUE); //disable libxml errors

if(!empty($html)){ //if any html is actually returned

	$pokemon_doc->loadHTML($html);
	libxml_clear_errors(); //remove errors for yucky html
	// print_r($pokemon_doc);
	$pokemon_xpath = new DOMXPath($pokemon_doc);

	//get all the h2's with an id
	//$pokemon_row = $pokemon_xpath->query('//h2[@id]');
	$pokemon_row = $pokemon_xpath->query('//span[@class="businessCapsule--name"]');
	//$pokemon_row1 = $pokemon_xpath->query('//span[@class="business--telephoneNumber"]');
	$pokemon_row1 = $pokemon_xpath->query('//div[@class="business--multiplePhonesWrapper"]');
	
	$pokemon_row2 = $pokemon_xpath->query('//span[@itemprop="address"]');
		//print_r($pokemon_row1);

	$phones = array();
	$all_address = array();
	$agency_names = array();

	$list = array(
		$phones,
		$all_address,
		$agency_names
	);

if($pokemon_row2->length > 0){
		foreach($pokemon_row2 as $row){
			array_push($all_address, $row->nodeValue);
			//echo $row->nodeValue . "<br/>";
		}
	}

	if($pokemon_row1->length > 0){
		foreach($pokemon_row1 as $row){
			array_push($phones, $row->nodeValue);
			//echo $row->nodeValue . "<br/>";
		}
	}

	if($pokemon_row->length > 0){
		foreach($pokemon_row as $row){
			array_push($agency_names, $row->nodeValue);
			//echo $row->nodeValue . "<br/>";
		}
	}
}

for($j=0;$j<count($phones);$j++) {
  echo '<table border="1">';
  echo('<tr>');
  echo('<td>' . $agency_names[$j] . '</td>');
  echo('<td>' . $phones[$j]. '</td>');
  echo('<td>' . $all_address[$j]. '</td>');
  echo('</tr>');
  echo '</table>';
}


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

<script type="text/javascript">
	var abc = "<?php echo $url ?>";
	console.log(abc);

</script>