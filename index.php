<!DOCTYPE html>
<html>
<head>
	<title>Denver Beer Map</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<link rel="icon" href="./images/beer-mug.png" />
	<link rel="stylesheet" type="text/css" href="./css/beer.css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maps.googleapis.com/maps/api/js?v=3.exp"></script>
	<script type="text/javascript" src="./js/infoBubble.js"></script>
	<script type="text/javascript" src="./js/beer.js"></script>
</head>
<body>
	<!--HEADER-->
	<header>
		<a href="index.php"><img class="headImg" src="./images/beer.png" alt="Denver Beer Map"/></a>
	</header>
	
	<!--BEER MAP-->
	<div id="gmap">
	</div>
	
	<!--LISTING-->
	<div id="listing">
	</div>
	
	<!--FOOTER-->
	<footer>
		<ul id="footerList">
			<li>&copy; Stephen Knutter</li>
			<li><a href="http://www.stephenknutter.com">Home</a></li>
			<li><a href="http://www.stephenknutter.com">About</a></li>
			<li><a href="http://www.stephenknutter.com">Contact</a></li>
		</ul>
	</footer>
</body>
</html>