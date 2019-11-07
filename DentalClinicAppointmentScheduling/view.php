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
			<li >
				<a href="manageDentist.php">manage Dentists</a>
			</li>
			
			<li class="selected">
				<a href="view.php">view Receptioinsts and Dentists</a>
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
					<span>view Dentist</span> 
				</div>
				<div class="article">
		            <div class="content">
		
						
						<br>
						<br>
			<?php	
						if($db = mysqli_connect('localhost', 'root', ''))
					{
						
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
						//}else echo"not selected";
					//}else echo "not connected";
	?>      <br>
		    <br>
			<br>
			<br>
		          </div><!--div class contant-->
				
		    </div><!--div l article-->
			
		</li>
		<li>
		            <br>
					<br>
					<br>
				<div class="figure">
					<span>view Receptionist</span> 
				</div>
				<div class="article">
					 <div class="content">
					 <form  action="" method="POST">
					<?php
					    	$query="select * from  Receptionist ";
								$list=@mysqli_query($db,$query);
								echo"<table>";
								echo"<tr>";
									echo"<th>Receptionist id</th>";
									echo"<th>name</th>";
									echo"<th>email</th>";
									echo"<th>phone</th>";
									
									echo"<th>address</th>";
							   echo"</tr>";
							
							while($row=mysqli_fetch_array($list,MYSQLI_ASSOC))
							{  
							  echo"<tr>";
								  echo"<td>".$row['Receptionist_id']."</td>";
								  echo"<td>".$row['firstName']." ".$row['LastName']."</td>";
								   echo"<td>".$row['email']."</td>";
								  echo"<td>".$row['phone']."</td>";
								  echo"<td>".$row['address']."</td>";
							  echo"</tr>";
							}
							echo"</table>";
						}else echo"not selected";
					}else echo "not connected";
	?>
					    
					
					<br>
					<br>
					<br>
	
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
