<?php
session_start();
if(isset($_SESSION['userId']))
{$pid=$_SESSION['userId'];}
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Personal Details - DentiSmile</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="header">
		<a href="Home.html" class="logo"><img src="images/1.png" alt=""></a>
		<ul>
		</ul>
	</div>
	<div id="body">
		
		
		
		<?php
		$db = mysqli_connect('localhost', 'root', '');
		@mysqli_select_db($db,'appointment');
		if(isset($_POST['insert']))
        { if(!empty($_POST['first'])&& !empty($_POST['last']) && !empty($_POST['phone'])
			&& !empty($_POST['email']) && !empty($_POST['address']) )
			{
				echo "<script type='text/javascript'> alert('...');</script>";
			  $first=$_POST['first'];
			  $last=$_POST['last'];
			  $phone=$_POST['phone'];
			  $email=$_POST['email'];
			  $address=$_POST['address'];
				
				
			$s="insert into patient values('$pid','$first','$last','$email','$phone','$address')";
			$r=@mysqli_query($db,$s);
			echo "<script type='text/javascript'> alert('.......');</script>";
			  if($r)
			  {
				echo "<script type='text/javascript'> alert('your officaily a user in this website');</script>";
				header('location: Home.php');
			  }
			}
			else
				echo "<script type='text/javascript'> alert('please fill them all');</script>";
		}
		?>
		
		<div class="content">
			
			<h2>Fill your details</h2>
			<form  method ="Post" action="">
				<label for="firstName"> <span>first name*</span>
					<input type="text" name="first" id="firstName">
				</label>
				<label for="lastName"> <span>last name*</span>
					<input type="text" name="last" id="lastName">
				</label>
				<label for="email"> <span>email*</span>
					<input type="text" name="email" id="email">
				</label>
				<label for="phoneNumber"> <span>Phone Number</span>
					<input type="text" name="phone" id="phoneNumber">
				</label>
				<label for="address"> <span>address*</span>
					<input type="text" name="address" id="subject">
				</label>
				
				<input type="submit" value="" id="submit" name="insert">
			</form>
		</div>	
	</div>	
	
		

		
    <div id="footer">
	<div>
	
			
		</div>
	</div>
</body>
</html>