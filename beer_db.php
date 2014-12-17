<?php
	require('beer_fns.inc.php');
	$conn = db_connect();
	$query = 'SELECT * FROM brews';
	$result = mysqli_query($conn, $query);
	
	function parseToXML($htmlStr){
		$xmlStr=str_replace('<','&lt;',$htmlStr);
		$xmlStr=str_replace('>','&gt;',$xmlStr);
		$xmlStr=str_replace('"','&quot;',$xmlStr);
		$xmlStr=str_replace("'",'&#39;',$xmlStr);
		$xmlStr=str_replace("&",'&amp;',$xmlStr);
		return $xmlStr;
	}
	
	header('Content-Type: text/xml');
	echo '<breweries>';
	while($row = mysqli_fetch_assoc($result)){
		echo '<brews ';
		echo 'brew="' .parseToXML($row['name']). '" ';
		echo 'address="' .parseToXML($row['address']). '" ';
		echo 'lat="' .$row['lat']. '" ';
		echo 'lng="' .$row['lng']. '" ';
		echo 'id= "' .$row['id']. '" ';
		echo '/>';
	}
	echo '</breweries>';
?>