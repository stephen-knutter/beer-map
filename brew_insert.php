<?php
	require('beer_fns.inc.php');
?>
<!DOCTYPE html>
<head>
	<title>Brew Insert</title>
	<style>
		label{
			display: inline-block;
			width: 110px;
		}
	</style>
</head>
<html>
<body>
<?php
	if(isset($_POST['add'])){
		$conn = db_connect();
		$name = $conn->real_escape_string(trim($_POST['name']));
		$address = $conn->real_escape_string(trim($_POST['address']));
		$lat = $conn->real_escape_string(trim($_POST['lat']));
		$lng = $conn->real_escape_string(trim($_POST['lng']));
		
		if(!empty($name) && !empty($address) && !empty($lat) && !empty($lng)){
			$query = "INSERT INTO brews VALUES('null', '".$name."', '".$address."', '".$lat."', '".$lng."')";
			$result = $conn->query($query);
			if($result){
				echo '<p style="color: green;">Success!</p>';
			} else {
				echo '<p style="color: red;">Fail!</p>';
			}
		} else {
			echo '<p style="color: red;">Form not filled out completely</p>';
		}
	}
?>
<h3>Brew Insert</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<label for="name">Name</label>
	<input type="text" id="name" name="name" /><br/>
	<label for="address">Address</label>
	<input type="text" id="address" name="address" /><br/>
	<label for="lat">Lat</label>
	<input type="text" id="lat" name="lat" /><br/>
	<label for="lng">Lng</label>
	<input type="text" id="lng" name="lng" />
	<input type="submit" name="add" value="Add" />
</form>
</body>
</html>