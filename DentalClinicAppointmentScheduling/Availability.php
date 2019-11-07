<?php
session_start();
$did=$_SESSION['userId'];

			$db = mysqli_connect('localhost', 'root', '');
			@mysqli_select_db($db,'appointment');
			
			if(isset($_POST['editavailable']))
			{
				if(!empty($_POST['days']))
				{
					// Loop to store and display values of individual checked checkbox.
					foreach($_POST['days'] as $i)
					{
						$q="insert into available values('$did','$i',1)";
						$l=@mysqli_query($db,$q);
						//if($l)
						// echo "<script type='text/javascript'> alert('$i');</script>";
						
					}
				}
			}
			
			
	
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
		    
			<li class="selected">
				<a href="Availability.php">Availability</a>
			</li>
			<li >
				<a href="Ddetails.php">MY Details</a>
			</li>
			<li>
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
			<h2>Edit Time</h2>
			<div id="blog">
			<div>
			
			<span> <h3>Choose date </h3>
			<form method="POST" action="Availability.php">
			<input type="date" name="date"></input> 
			<input type="Submit" name="ok" value="ok" ></input>
		    </form></span>
			
	
		 </div>
			<div>
			<?php
			if(isset($_POST['ok']) && !empty($_POST['date']) )
			{
			  $_SESSION['date']=$_POST['date'];
				
 			  $times=array("8:00AM"=>1,"9:00AM"=>2,"10:00AM"=>3,"11:00AM"=>4,"12:00PM"=>5,
			                 "1:00PM"=>6,"2:00PM"=>7,"3:00PM"=>8,"4:00PM"=>9); ?>
				<form method="POST" action="">
						<table border="2">
							<?php
								$nameOfDay = date('l', strtotime($_POST['date']));
							$q="select *  from bookedtime where
							//		Dentist_id='".$did."'and Date='".$date;
							//		$l=@mysqli_query($db,$q);
							
							
								foreach($times as $v=>$x)
								{
									echo "<tr>";
									echo "<td> <input type='checkbox' value=$x name=$x checked >$v</input></td>";
									echo "</tr>";
								}
								echo "<tr>";
								echo"<td><input type='submit' value='Confirm' name='confirm'></td>";
								echo "</tr>";
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