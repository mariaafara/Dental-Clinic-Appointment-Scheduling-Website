<?php
session_start();

?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Personal Details - DentiSmile</title>
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
			<li>
				<a href="Appointments.php">my Appointments</a>
			</li>
			<li class="selected">
				<a href="Details.php">my details</a>
			</li>
			<li>
				<a href="login.php">logout</a>
			</li>
			
			
		</ul>
	</div>
	<div id="body">
		
		<div class="content">
		<?php
		$db = mysqli_connect('localhost', 'root', '');
		@mysqli_select_db($db,'appointment');
		
		if(isset($_SESSION['userId']))
        $pid=  $_SESSION['userId'] ;
	
	   if(isset($_POST['edit']))
		{
			$first=$_POST['first'];
			$last=$_POST['last'];
			$email=$_POST['email'];
			$phone=$_POST['phone'];
			$address=$_POST['address'];
			$up="update patient set firstName='$first' , LastName='$last' ,
			email='$email' ,phone='$phone' ,address='$address' where Patient_id='$pid'";
			if($update=@mysqli_query($db,$up))
				 echo "<script type='text/javascript'> alert('edited successfuly');</script>";	
		}
		
		
		
	
		$query="select * from  patient where Patient_id='".$pid."'";
	    $res=@mysqli_query($db,$query);
		while($row=mysqli_fetch_array($res,MYSQLI_ASSOC))
		{
		
			?>
			<h2>Edit your details</h2>
			<form  method="POST" action="Details.php">
				<label for="firstName"> <span>first name*</span>
					<input type="text" name="first" id="firstName" value ="<?php echo $row['firstName']?>">
				</label>
				<label for="lastName"> <span>last name*</span>
					<input type="text" name="last" id="lastName"  value ="<?php echo $row['LastName']?>">
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
				
				<input type="submit" value="" id="submit" name="edit">
			</form>
		</div>
		
		<?php 
		}	// end of while
		?>
	
		<div class="sidebar">
		<?php
		$db = mysqli_connect('localhost', 'root', '');
	
		
		@mysqli_select_db($db,'appointment');
		
	
        echo "<script type='text/javascript'> alert('".$pid."');</script>";	
	
		$s="select address, phone, email, firstName, LastName from  patient where Patient_id='".$pid."'";
	    $r=@mysqli_query($db,$s);
	
	    while($row=mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
		?>
			<h3>Profile</h3>
			<ul>
				<li>
					<span class="address">address</span>
					<ul>
						<li>
							<?php echo $row['address'];?>
						</li>
					</ul>
				</li>
				<li>
					<span class="phone">telephone</span>
					<ul>
						<li>
							<?php echo $row['phone'];?>
						</li>
					</ul>
				</li>
				<li>
					<span class="email">email</span>
					<ul>
						<li>
							<?php echo $row['email'];?>
						</li>
					</ul>
				</li>
				<li>
					
				</li>
			
			</ul>
    <?php 
	
       }//end of fetch while
	}//if   
	   
	   ?>
	   
		</div>
</div>
	
	<div id="footer">
		<div>
			
		</div>
	</div>
</body>
</html>