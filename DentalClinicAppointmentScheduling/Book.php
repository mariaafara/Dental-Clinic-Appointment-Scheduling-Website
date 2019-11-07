<?php
session_start();
$pid=$_SESSION['userId'];
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Book Appointment - dentiSmile </title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="header">
		<a href="home.php" class="logo"><img src="images/1.png" alt=""></a>
		<ul>
		    
		    <li>
			</li>
			<li>
				<a href="Home.php">home</a>
			</li>
			<li class="selected">
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
	
			<!---------------------------------------------->
	<?php
	
	echo'<h2>Book a new Appointment</h2>';
	if($db = mysqli_connect('localhost', 'root', ''))
	{
		
		if(@mysqli_select_db($db,'appointment'))
		{
			if(!isset($_SESSION['displayform1'])){
				$_SESSION['displayform1']=true;
				$_SESSION['displayform2']=false;
			}
			
			if(isset($_POST['submit']))
			{
				$_SESSION['displayform1']=false;
			    $_SESSION['displayform2']=true;
				$_SESSION['time']=$_POST['time'];
			 
			}
			
			if($_SESSION['displayform1'])
			{	
			
				$query="select Dentist_id from  dentist ";
				$list=@mysqli_query($db,$query);
			
					echo'<form  method="POST"  action="Book.php">';
					
					echo'<label for="select Dentist"> <span>select Dentist</span>';
						
						/*
						if(isset($_SESSION['did']))//kermel lma t3mel reload lpage dal msyve vaalue id lal dentist
						{
							$did_temp=$_SESSION['did'];
							
						}else
						{
							$did_temp=-1;
						}
						
						*/
						
					echo'<select name="did">';
					while($row=mysqli_fetch_array($list,MYSQLI_ASSOC))
					{         /*
							  if($did_temp==$row[Dentist_id])
							  echo"<option value=".$row[Dentist_id]." selected='selected'>".$row[Dentist_id]."</option>";
						  else */
					  echo"<option value=".$row[Dentist_id]." >".$row[Dentist_id]."</option>";
							
					}
					echo'</select>';
					echo"<br>";
					echo"<br>";
					echo'<label for="select Date"> <span>select Date</span>';
						
						/*if(isset($_SESSION['date']))
						{
							echo'<input type="date" name="appDate" value='.$_SESSION['date'].' ></input> ';
						} else					  
						*/
					echo'<input type="date" name="appDate"  ></input> ';
					//echo"<br>";
					//echo"<br>";	
					
					echo"<span></span><span></span>";
					echo'<input type="submit" value="search time" name="searchtime">';
				    echo"</label>";
						
					if(isset($_POST['searchtime']))//|| isset($_POST['submit'])	
					{
					    if(!empty($_POST['appDate']) && isset($_POST['did']))
						{  
					        $did=$_POST['did'];//dentist id selected
							
			              /***************************************************************/
						    $_SESSION['did']=$did;//save l id tb3 ldentist bel session
						  /***************************************************************/
						  
						 $date=$_POST['appDate'];//Y-m-d
							
						  //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
							
							 //echo $date=strtotime($date);
							 echo"<br>";
							//echo $date=date('d-m-Y',$date); //d-m-Y 7awalet ldate l hal format
							//$_SESSION['dateformat']=$dateformat;
							 /***************************************************************/
						    $_SESSION['date']=$date;
							/***************************************************************/	
							  echo"<br>";
							$nameOfDay = date('l', strtotime($date));//D btrj3le half of word ,l btrje3a kela
							
							 /***************************************************************/
							$_SESSION['dayname']=$nameOfDay;
							 /***************************************************************/
							
							$query="select Avaliable  from  available where Dentist_id='".$did."' and Day_name='".$nameOfDay."'";//Avaliable ketbita 8lt bl mysql ntbeh!
							$list=@mysqli_query($db,$query);
								
							while($row=mysqli_fetch_array($list,MYSQLI_ASSOC))
							{
								if($row['Avaliable']==1)
								{ 
									$q="select *  from time where timeId not in (select timeId from bookedtime where
									Dentist_id='".$did."'and Date='".$date."')";
									$l=@mysqli_query($db,$q);
									$num_available_time=@mysqli_num_rows($l);
									
							     	if($num_available_time <> 0)
							    	{
										echo'<label for="select time"> <span>select time</span>';
										
										echo"<select name='time'>";
										while($r=mysqli_fetch_array($l,MYSQLI_ASSOC))
										{
									        echo"<option value=".$r["time"]."-".$r["timeId"]." >".$r["time"]."</option>";
									 	
									     }
										echo"</select>";
										
										/***************************************************************/
									
										
										/***************************************************************/
										
										echo"</label>";
								     	echo'<input type="submit" value="" id="submit" name="submit">';
							    	}
									else
									    echo"all time are booked on this day please choose another day :)";
								}
								else 
									echo " Dentist of id ".$did."not available on".$nameOfDay." ".$date;
							}
					    } else echo"please fill all infos";
					}//if isset searchtime
					
				   echo"</form>";
			}		   
		}else echo"not selected";
	}else echo "not connected";
	?>
	<?php if($_SESSION['displayform2'])
			{
				
				echo'<h3>your appointment details :</h3>';
				$t1=$_SESSION['time'];
			    $t2 =  explode('-', $t1);
				$time=$t2[0];
				$timeId=$t2[1];
				$date=$_SESSION['date'];
				$did=$_SESSION['did'];
				$nameofDay=$_SESSION['dayname'];
			//	$_SESSION['dateformt']=$dateformat;//d-m-y
	?>
				<div class="section">
				<div>
					<span>Dentist ID</span>
					<ul>
						<li>
							<ul>
								<li>
									<?php echo $did; ?>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				<div>
					<span>Date</span>
					<ul>
						<li>
							<ul>
								<li>
									<?php  echo $date; ?>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				<div>
					<span>Time</span>
					<ul>
						<li>
							<ul>
								<li>
									<?php echo $time; ?>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				</div><!--section--->
	<div >	
	<?php 
			echo'
			 
			   
			   <br>
			   <br>
			   <form method=POST action="Book.php" >
			   <div >
			   <label>
			          <input type="submit" value="cancel" name="cancel">
			   </label>
			  </div>
			   <div >
			   <label>
			          <input type="submit" value="book" name="book">
			   </label>
			   </div>
			   
			   </form>
			 
			  
				';
				
				if(isset($_POST['cancel']))
				{  
			        unset( $_SESSION['displayform1']);
					unset( $_SESSION['displayform2']);
					$_SESSION['displayform2']=false;
					$_SESSION['displayform1']=true;
				}
			
				if(isset($_POST['book']))
				{  
			     	$end="";
					//echo "<script type='text/javascript'> alert('...........');</script>";
					
				if($time=='8:00AM')
						$end="9:00AM";
				else 
					if($time=='9:00AM')
						$end="10:00AM";
				else
					if($time=='10:00AM')
						$end="11:00AM";	
				else
					if($time=='11:00AM')
						$end="12:00PM";
				else
					if($time=='12:00PM')
						$end="1:00PM";
				else
					if($time=='1:00PM')
						$end="2:00PM";	
				else
					if($time=='2:00PM')
						$end="3:00PM";	
				else
					if($time=='3:00PM')
						$end="4:00PM";
                else
					if($time=='4:00PM')
						$end="5:00PM";	
				
				
				 $b="insert into appointment values (NULL,'$pid','$did','$time','$end',0,'$date')";			
			     $x="insert into bookedtime values('$did','$date','$timeId')";
			     $bt=@mysqli_query($db,$x);
                 $book=@mysqli_query($db,$b);
		   	    
				
									
				    unset( $_SESSION['displayform1']);
					unset( $_SESSION['displayform2']);
					$_SESSION['displayform2']=false;
					$_SESSION['displayform1']=true;
					
					if($bt)
					echo "<script type='text/javascript'> alert('appointment scheduled successfuly');</script>";
				  	
				
			}
	
			}	//close of if
	?>		
			</div>
			
				
	</div><!--content-->
	
    </div><!----body-->
	
	<div id="footer">
		<div>
			
		</div>
	</div>
</body>
</html>




<!--

INSERT INTO `availabletime`VALUES('200',STR_TO_DATE('01/05/2010', '%m/%d/%Y'),'8:00AM',1)

INSERT INTO `availabletime`VALUES('200',STR_TO_DATE('12/05/2010', '%d/%m/%Y'),'8:00AM',1)

INSERT INTO `availabletime`VALUES('200',STR_TO_DATE('12/05/2010', '%d/%m/%Y'),'8:00AM',1)



-->