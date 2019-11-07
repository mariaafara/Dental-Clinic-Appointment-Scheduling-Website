<?php


$db = mysqli_connect('localhost', 'root', '');
@mysqli_select_db($db,'appointment');
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>add | delete Receptionist - DentiSmile</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="header">
		<a href="" class="logo"><img src="images/1.png" alt=""></a>
		<ul>
			<li >
				<a href="manageReceptionist.php">manage Receptionists</a>
			</li>
			<li class="selected">
				<a href="manageDentist.php">manage Dentists</a>
			</li>
			
			<li>
				<a href="view.php">view Receptioinsts and Dentists</a>
			</li>
			
			
			
		</ul>
	</div>
	<div id="body">
		<ul>
			<li>
				<div class="figure">
					<span>Add Dentist</span> 
				</div>
				<div class="article">
		            <div class="content">
		
						<form  method="POST" action="manageDentist.php">
						<br>
						<br>
						<label for="ID"> <span>Dentist Id*</span>
								<input type="text" name="id" id="firstName" ">
							</label>
							<label for="firstName"> <span>first name*</span>
								<input type="text" name="first" id="firstName" ">
							</label>
							<label for="lastName"> <span>last name*</span>
								<input type="text" name="last" id="lastName" ">
							</label>
							<label for="speciality"> <span>Speciality*</span>
								<input type="text" name="speciality" id="subject"  ">
							</label>
							<label for="email"> <span>email*</span>
								<input type="text" name="email" id="email"  ">
							</label>
							<label for="phoneNumber"> <span>Phone Number</span>
								<input type="text" name="phone" id="phoneNumber"  ">
							</label>
							<label for="address"> <span>address*</span>
								<input type="text" name="address" id="subject"  ">
							</label>
							<br>
							<input type="submit" value="" id="submit" name="add" >
							<br>
						</form>
		          </div><!--div class contant-->
					<?php
					if(isset($_POST['add']))
					{ if(!empty($_POST['id'])&& !empty($_POST['speciality'])&&!empty($_POST['first'])&& !empty($_POST['last']) && !empty($_POST['phone'])
						&& !empty($_POST['email']) && !empty($_POST['address']) )
						{
						  $id=$_POST['id'];
						  $first=$_POST['first'];
						  $speciality=$_POST['speciality'];
						  $last=$_POST['last'];
						  $phone=$_POST['phone'];
						  $email=$_POST['email'];
						  $address=$_POST['address'];
						  //5let lpassword ykoun id le2elo and role Dentist
							$l="insert into login values('$id','$id','Dentist')";
							$log=@mysqli_query($db,$l);	
							if($log)
							{   
								$s="insert into dentist values('$id','$first','$last','$email','$phone', '$speciality','$address')";
								$r=@mysqli_query($db,$s);
								//----------------------------------
								
								//---------------------------------------
								echo "<script type='text/javascript'> alert('inserted successfuly');</script>";
							}
						}
					}
					
					if(isset($_POST['delete']))
			 {
			  $selected=$_POST['did'];
			  //$did =  explode(' ', $selected);
		
			 // echo "<script type='text/javascript'> alert('$did[0]');</script>";
			   
			  $d="delete  from login where UserId=$did"; 
			  $del=@mysqli_query($db,$d);
			  $query="delete from dentist where Dentist_id=$did";
			  $list=@mysqli_query($db,$query);
			  if($list)
			  {   
       		    echo "<script type='text/javascript'> alert('Deleted successfuly');</script>";
    		  }
			 }
			?>
					
	
		    </div><!--div l article-->
			
		</li>
		<li>
				<div class="figure">
					<span>Delete Dentist</span> 
				</div>
				<div class="article">
					 <div class="content">
					 <form  action="" method="POST">
					<?php
					     $query="select Dentist_id ,firstname, lastname from dentist";
				         $list=@mysqli_query($db,$query);
					    echo'<br><br><label for=" Dentist id"> <span> Choose Dentist</span>';
						echo'<select name="did">';
					while($row=mysqli_fetch_array($list,MYSQLI_ASSOC))
					{         
					  echo"<option value=$row[Dentist_id] >".$row[Dentist_id]." ".$row[firstname]." ".$row[lastname]."</option>";
							
					}
					
					echo'</select>';
					echo"</label>";
					    echo'<br><br><input type="submit" value="" id="submit" name="delete"><br>';
						
						
						
					    
					?>
					</form>
					</div>
				</div>
			</li>
	</ul><!--ul b3d lbody-->
	
		
</div><!--div l body-->
	
	<div id="footer">
		<div>
			
		</div>
	</div>
</body>
</html>