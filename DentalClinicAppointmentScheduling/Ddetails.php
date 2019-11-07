<?php
session_start();
$did=$_SESSION['userId'];
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Dentist details - dentiSmile </title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="header">
		<a href="home.php" class="logo"><img src="images/1.png" alt=""></a>
		<ul>
		    
			<li>
				<a href="Availability.php">Availability</a>
			</li>
			<li class="selected">
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
		<ul>
			<li>
				<div class="figure">
					<span>My details</span> 
				</div>
				<div class="article">
			<!---------------------------------------------->
	
	<?php
	
	if($db = mysqli_connect('localhost', 'root', ''))
	{
		
		if(@mysqli_select_db($db,'appointment'))
		{
			
			 if(isset($_POST['submitedit']))
				{
					$first=$_POST['first'];
					$last=$_POST['last'];
					$email=$_POST['email'];
         			$phone=$_POST['phone'];
					$address=$_POST['address'];
					$spec=$_POST['spec'];
					$up="update dentist set firstname='$first' , lastname='$last' ,
					email='$email' ,phone='$phone' ,address='$address' , Speciality='$spec' where Dentist_id='$did'";
					$update=@mysqli_query($db,$up);
					 //echo "<script type='text/javascript'> alert('edited successfuly');</script>";	
				}
			
			
				$query="select * from  dentist where Dentist_id='$did'";
				$list=@mysqli_query($db,$query);
			
					
                    echo"<table>";
			        echo"<tr>";
					echo"<th>Full name </th>";
					echo"<th>speciality</th>";
					echo"<th>phone</th>";
					echo"<th>email</th>";
					echo"<th>address</th>";
					
			   echo"</tr>";
					
					while($row=mysqli_fetch_array($list,MYSQLI_ASSOC))
					{    
					echo"<tr>";
						  echo"<td >".$row['firstname']." ".$row['lastname']."</td>";
						  echo"<td >".$row['Speciality']."</td>";
						   echo"<td>".$row['phone']."</td>";
						  echo"<td>".$row['email']."</td>";
						  echo"<td>".$row['address']."</td>";
					  echo"</tr>";
					}
					
					echo"</table><br><br><br>";?>
					
					<div class="article">
					<div class="content">
					<form  method="POST"  action="">
					<?php
					    echo'<label for=" "> <span> </span>';
					    echo'<br><br><br><input type="submit" value="Edit information"  name="edit">';
						echo"</label>";
					?>
					</form>
					</div>
					</div>
					<?php if(isset($_POST['edit']))
					{
					?>
					<li>
					<div class="figure">
					<span>Edit My Details</span> 
			         </div>
						<div class="article">
						<div class="content">
						<form  method="POST" action="Ddetails.php">
						<?php
											
						  
						$query="select * from  dentist where Dentist_id='$did'";
						$list=@mysqli_query($db,$query);
						while($row=mysqli_fetch_array($list,MYSQLI_ASSOC))
						{  
					?> 
					<br><br><br><br>
							<label for="firstName"> <span>first name*</span>
								<input type="text" name="first" id="firstName" value ="<?php echo $row['firstname']?>">
							</label>
							<label for="lastName"> <span>last name*</span>
								<input type="text" name="last" id="lastName"  value ="<?php echo $row['lastname']?>">
							</label>
							<label for="email"> <span>email*</span>
								<input type="text" name="email" id="email"  value ="<?php echo $row['email']?>">
							</label>
							<label for="phoneNumber"> <span>Phone Number</span>
								<input type="text" name="phone" id="phoneNumber"  value ="<?php echo $row['phone']?>">
							</label>
							<label for="address"> <span>address*</span>
								<input type="text" name="address" id="subject"  value ="<?php echo $row['address']?>">
							</label>
							<label for="spec"> <span>Speciality</span>
								<input type="text" name="spec" id="subject"  value ="<?php echo $row['Speciality']?>">
							</label>
							
							<input type="submit" value="" id="submit" name="submitedit">
				
		<?php  
						}//while
						
	
						
						
						
		?>
			       </form>
					</div><!--content-->
					</div><!--article-->
					</li>
					
 <?php		
					}//if isset edit
		}else echo"not selected";
	}else echo "not connected";
	?>
	</li>
	
	
	
	</div><!--article-->
	
				
	<div >	
	
	</div>
			
				
	
	</li>
	</ul>
    </div><!----body-->
	
	<div id="footer">
		<div>
			
		</div>
	</div>
</body>
</html>