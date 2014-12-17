<?php
	require('beer_fns.inc.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Insert Breweries</title>
	<style>
		label{
			display: inline-block;
			width: 200px;
		}
		
	</style>
</head>
<?php
	if(isset($_POST['add'])){
		$conn = db_connect();
		$brew = $conn->real_escape_string(trim($_POST['brew']));
		$address = $conn->real_escape_string(trim($_POST['address']));
		$lat = $conn->real_escape_string(trim($_POST['lat']));
		$lng = $conn->real_escape_string(trim($_POST['lng']));
		
		if(!empty($brew) && !empty($address) && !empty($lat) && !empty($lng)){
			$query = "INSERT INTO brews VALUES('null', '".$brew."', '".$address."', '".$lat."', '".$lng."')";
			$result = $conn->query($query);
			if($result){
				echo '<p style="color: green;">Database updated successfully</p>';
			} else {
				echo '<p style="color: red;">Database entry error</p>';
			}
		}
	}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<label for="name">Brew Name</label>
	<input type="text" name="brew" /><br/>
	<label for="address">Address</label>
	<input type="text" name="address" /><br/>
	<label for="lat">Latitude</label>
	<input type="text" name="lat"><br/>
	<label for="lng">Longitude</label>
	<input type="text" name="lng" />
	<input type="submit" name="add" value="Add Brew" />
</form>
<?php
	
?>
</html>