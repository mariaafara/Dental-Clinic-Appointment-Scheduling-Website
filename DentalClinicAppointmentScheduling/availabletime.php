<?php
session_start();
$did=$_SESSION['userId'];
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Availability | dentiSmile</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="header">
		<a href="home.php" class="logo"><img src="images/1.png" alt=""></a>
		<ul>
		    
			<li>
				<a href="#"></a>
			</li>
			<li >
				<a href="#"></a>
			</li>
			<li>
				<a href="#"></a>
			</li>
			<li>
				<a href="#"></a>
			</li>
			<li>
				<a href="login.php">logout</a>
			</li>
			
		</ul>
	</div>
	<div id="body">
	<div class="content">
			<form method='POST' action="Availability.php">

			<table>
			<tr>
		     <th><h3>Available Days</h3></th></tr>
	
				<tr>
					<td><h2><input type='checkbox' value="Monday" name="days[]">Monday</input></h2></td>
				</tr>
				<tr>
					<td><h2><input type='checkbox'  value="Tuesday" name="days[]">Tuesday</input></h2></td>
				</tr>
				<tr>
					<td><h2><input type='checkbox'  value="Wednesday" name="days[]">Wednesday</input></h2></td>
				</tr>
				<tr>
					<td><h2><input type='checkbox'  value="Thursday" name="days[]">Thursday</input></h2></td>
				</tr>
				<tr>
					<td><h2><input type='checkbox'  value="Friday" name="days[]">Friday</input></h2></td>
				</tr>
				<tr>
					<td><h2><input type='checkbox'  value="Saturday" name="days[]">Saturday</input></h2></td>
				</tr>
				<tr>
					<td><input type="Submit" name="editavailable" id="Submit" ></input></td>
				</tr>
				</form>
			</ul>
			
		</div>
	</div>
	
</body>
</html>