<?php
session_start();

?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Appointments managment - dentiSmile</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="header">
		<a href="Home.php" class="logo"><img src="images/1.png" alt=""></a>
		<ul>
		   
			<li>
				<a href="Home.php">home</a>
			</li>
			<li>
				<a href="Book.php">book</a>
			</li>
			<li class="selected">
				<a href="Appointments.php">my appointments</a>
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
		<ul>
			<li>
				<div class="figure">
					<span>Appointments</span> 
				</div>
				<div class="article">
	<?php
		if($db = mysqli_connect('localhost', 'root', '')){
		
		if(@mysqli_select_db($db,'appointment'))
		{
			 if(isset($_SESSION['userId']))
                $pid=  $_SESSION['userId'] ;		
			
			////////////////////////////////////////////////////////////////////////////
			 if(isset($_POST['submit']))
			 {
			  $app_id=$_POST['app_id'];
			  echo "<script type='text/javascript'> alert('$app_id');</script>";
			  $q="select Appointment_id from appointment where Patient_id='".$pid."'";
	          $l=@mysqli_query($db,$q);
			  $count=0;
			  while($r=mysqli_fetch_array($l,MYSQLI_ASSOC))
			  {
			    if($r['Appointment_id']==$app_id)//to check that the patient do not cancel an appointment of another patient by mistake
				  {
			     	  $query="update appointment set Canceled=1 where Appointment_id='".$app_id."'";
					  $list=@mysqli_query($db,$query);
							  
					  if($list)
					  {   
			          $count++;
					  echo "<script type='text/javascript'> alert('Appointment canceled successfuly');</script>";
					  }
				  }	  
			  
							 
		    }//while close
			if($count==0)
			  echo "<script type='text/javascript'> alert(' Sorry ,you dont have an appointment with this id');</script>";			
		}//if close
		
		////////////////////////////////////////////////////////////////////////////
			
				$query="select Appointment_id,Dentist_id,Date,StartTime,EndTime from  appointment where Patient_id='".$pid."' and Canceled=0";
				$list=@mysqli_query($db,$query);
			    echo"<table>";
			    echo"<tr>";
					echo"<th>Appointment id</th>";
					echo"<th>Dentist id</th>";
					echo"<th>Date</th>";
					echo"<th>Start time</th>";
					echo"<th>End time</th>";
					echo"<th></th>";
			   echo"</tr>";
			
			while($row=mysqli_fetch_array($list,MYSQLI_ASSOC))
			{  
		      echo"<tr>";
				  echo"<td>".$row['Appointment_id']."</td>";
				  echo"<td>".$row['Dentist_id']."</td>";
				   echo"<td>".$row['Date']."</td>";
				  echo"<td>".$row['StartTime']."</td>";
				  echo"<td>".$row['EndTime']."</td>";
			  echo"</tr>";
			}
			echo"</table>";
		}else echo"not selected";
	}else echo "not connected";
		?>
				</div>
			</li>
			<li>
				<div class="figure">
					<span>Cancel appointment</span> 
				</div>
				<div class="article">
					 <div class="content">
					 <form  action="" method="POST">
					<?php
					     
					    echo'<label for=" Appointment  id"> <span> Appointment id</span>';
						echo'<input type="text" name="app_id" >';
					    echo'<input type="submit" value="" id="submit" name="submit">';
						echo"</label>";
						
						
					    
					?>
					</form>
					</div>
				</div>
			</li>
			
		</ul>
	</div>
	<div id="footer">
		<div>
			
		</div>
	</div>
</body>
</html>