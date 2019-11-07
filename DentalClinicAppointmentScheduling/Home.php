<?php
session_start();
?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Home dentiSmile</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="header">
		<a href="Home.php" class="logo"><img src="images/1.png" alt=""></a>
		<ul>
		    <li>
			</li>
		    <li>
			</li>
			<li class="selected">
				<a href="Home.php">home</a>
			</li>
			<li>
				<a href="Book.php">book</a>
			</li>
			<li>
				<a href="Appointments.php">my Appointments</a>
			</li>
			<li>
				<a href="Details.php">my details</a>
			</li>
			<li>
				<a href="login.php">logout</a>
			</li>
			
		</ul>
	</div>
	<div id="body">
		
		
		
		<div class="content">
		
			<h2>about</h2>
			<h3>Our dentists are the best in their specialities</h3>
			
			<P>
			Welcome to our humble page  hope you feel the easinnes in scheduling appointments and savings time while using this site!
			</P>
			
			<h3>Dentists list</h3>
			<div>
				<?php
		if($db = mysqli_connect('localhost', 'root', '')){
		
		if(@mysqli_select_db($db,'appointment'))
		{
				$query="select * from  dentist ";
				$list=@mysqli_query($db,$query);
			    echo"<table>";
			    echo"<tr>";
					echo"<th>dentist id</th>";
					echo"<th>name</th>";
					echo"<th>email</th>";
					echo"<th>phone</th>";
					echo"<th>speciality</th>";
					echo"<th>address</th>";
			   echo"</tr>";
			
			while($row=mysqli_fetch_array($list,MYSQLI_ASSOC))
			{  
		      echo"<tr>";
				  echo"<td>".$row['Dentist_id']."</td>";
				  echo"<td>".$row['firstname']." ".$row['lastname']."</td>";
				   echo"<td>".$row['email']."</td>";
				  echo"<td>".$row['phone']."</td>";
				  echo"<td>".$row['Speciality']."</td>";
				  echo"<td>".$row['address']."</td>";
			  echo"</tr>";
			}
			echo"</table>";
		}else echo"not selected";
	}else echo "not connected";
		?>
			</div>
			
		</div>
	</div>
	<div id="footer">
		<div>
			
		</div>
	</div>
</body>
</html>