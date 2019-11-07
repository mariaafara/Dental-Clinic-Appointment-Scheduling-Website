<?php
session_start();
$did=$_SESSION['userId'];
//echo "<script type='text/javascript'> alert(".date('Y-m-d').");</script>";
			$db = mysqli_connect('localhost', 'root', '');
			@mysqli_select_db($db,'appointment');
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>patient descriptions | Denti Smile</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="header">
		<a href="index.html" class="logo"><img src="images/logo.png" alt=""></a>
		<ul>
			<li >
				<a href="Availability.php">Availability</a>
			</li>
			<li >
				<a href="Ddetails.php">MY Details</a>
			</li>
			<li >
				<a href="Dappointments.php">my Appointments</a>
			</li>
			<li class="selected">
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
					<span></span><span> Patient_id</span>
				</div>
				<div class="article">
				 <div class="content">
					 <form  action="Description.php" method="POST">
					<?php
					if(isset($_SESSION['pid']))
						$p=$_SESSION['pid'];
					else
						$p=" " ;
					
					    echo'<label for=" patient id"> <span> </span>';
						echo'<input type="text" name="pid" value='.$p.' >';
					    echo'<input type="submit" value="" id="submit" name="submit">';
						echo"</label>";
						//lezm a3ml select lkel l id wkaren iza lid lfwta correct or not
					 
					?>
					</form>
					</div>
				</div>
			</li>
			<?php
				if(isset($_POST['submit']) && !empty($_POST['pid']))
					{		
						$pid=$_POST['pid'];
						$_SESSION['pid']=$pid;
						$query="select FirstName , LastName  from  patient where 
								Patient_id='".$pid."'";
						$list=@mysqli_query($db,$query);
						while($r=mysqli_fetch_array($list,MYSQLI_ASSOC))
						{
							
			?>
			<li>
				<div class="figure">
					 <span> Patient first Name </span>
					
				</div>
				<div class="article">
					<ul>
						<li>
						    <div class="content">
							<input type="text" name="f" value=" <?php echo $r["FirstName"];?>" >
						
							</div>
						</li>
						
					</ul>
				</div>
			</li>
			<li>
				<div class="figure">
					<span> Patient last Name </span>
				</div>
				<div class="article">
					<ul>
						<li>
						    <div class="content">
							<input type="text" name="l" value="<?php echo $r["LastName"];?>" >
							</div>
						</li>
					</ul>
				</div>
			</li>
			<li> 
			<?php 
						}//while close
				
			?>
			<form  action="" method="POST">
				<div class="figure">
					<span> Treated for </span>
				</div>
				<div class="article">
					<ul>
						<li>
						    <div class="content">
							<input type="text" name="for" value="" >
							</div>
						</li>
						
					</ul>
					
				</div>
			</li>
			<li>
			<div class="figure">
					 <span> treatment </span>
				</div>
				<div class="article">
						<ul>
						<li>
						    <div class="content">
							<label>
							<input type="text" name="treatment" value="" >
							</label>
							</div>
						</li>
					</ul>
				</div>
			</li>
			
			<li>
			<div class="figure">
					 <span> </span> <span> Notes </span>
				</div>
				<div class="article">
				<ul>
					<li>
					   <div class="content">
						<label >
						<textarea name="notes" id="message" cols="30" rows="5"></textarea>
					    </label>
						</div>
					</li>
				</ul>
				</div>
			</li>
			<li>
			<div class="figure">
					<span><br></span> 
				</div>
				<div class="article">
					<div class="content">
					
					 <input type="submit" id="Submit"  name="add">
				
					</div>
					</form>
				</div>
				
				</li>
		</ul>
	<?php	}//if isset submit close
	
	if(isset($_POST['add']) && !empty($_POST['for']) && !empty($_POST['treatment'])  && !empty($_POST['notes']))
	{ $pid=$_SESSION['pid'];
		$for=$_POST['for'];
		$t=$_POST['treatment'];
		$n=$_POST['notes'];
		
		$qu="insert into description values('$did' , '$pid' , '$for ', '$t' ,'$n',now())";
		if(@mysqli_query($db,$qu))
			echo "<script type='text/javascript'> alert('added successfuly');</script>";
	}
	
	?>
</body>
	
</html>