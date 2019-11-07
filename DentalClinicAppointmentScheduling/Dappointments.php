<?php
session_start();
$did=$_SESSION['userId'];

			$db = mysqli_connect('localhost', 'root', '');
			@mysqli_select_db($db,'appointment');
			
			
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
		    
			<li >
				<a href="Availability.php">Availability</a>
			</li>
			<li >
				<a href="Ddetails.php">MY Details</a>
			</li>
			<li class="selected">
				<a href="Dappointments.php">my Appointments</a>
			</li>
			<li>
				<a href="Description.php">Add description</a>
			</li>
			<li>
				<a href="login.php">logout</a>
			</li>
			
		</ul>
	</div>
	<div id="body">
		
		<div class="content">
			<h2>choose date</h2>
			
			
			<form method="POST" action="">
			<input type="date" name="date"></input> 
			<input type="Submit" name="ok" value="ok" ></input>
		    </form></span>
			
	
		
			<div class="article">
			<?php
			if(isset($_POST['ok']) && !empty($_POST['date']) )
			{ 
		      $date=$_POST['date'];
			  $_SESSION['date']=$_POST['date'];
				
 			   ?>
				<form method="POST" action="">
				<table border="2">
				<?php
				$query="select a.Patient_id ,a.StartTime,a.EndTime ,patient.FirstName ,patient.LastName from  appointment a, 
				patient where a.Dentist_id='".$did."' and a.Date='$date' and a.Canceled=0 and a.Patient_id=patient.Patient_id";
				$l=@mysqli_query($db,$query);
				 echo"<br><br><tr>";
					echo"<th>Patient id</th>";
					echo"<th>Name</th>";
					echo"<th>Start time</th>";
					echo"<th>End time</th>";
					echo"<th></th>";
			   echo"</tr>";		
				while($row=mysqli_fetch_array($l,MYSQLI_ASSOC))
				{
			   	  echo"<tr>";
				  echo"<td>".$row['Patient_id']."</td>";
				  echo"<td>".$row['FirstName']." ".$row['LastName']."</td>";
				  echo"<td>".$row['StartTime']."</td>";
				  echo"<td>".$row['EndTime']."</td>";
			      echo"</tr>";
				}
					
				?>
				</table>
				</form>
	<?php   } ?>
	   </div>
	     </div><!--blog-->
			
			<br>
			
		</div>
	</div>
	
</body>
</html>