<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Connect to MySQL</title>
</head>
<body>
	<!-- Creates database connection. Used in clientpages -->
	<?php
		if ($dbc=mysqli_connect("127.0.0.1:3306","249964","gOALipMB","249964")) {
			//echo "<p>Successfully connected to the server</p>";
		}
		else{
			echo "<p style="."color:red".">Could not connect to the server:<br>".mysqli_connect_error().".</p>";
		}
	?>
</body>
</html>