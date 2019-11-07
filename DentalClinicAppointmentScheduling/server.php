<?php
session_start();

// variable declaration
$userId = "";
//$role="";
$errors = array(); 
$_SESSION['success'] = "";
		
		
// connect to database
if($db = mysqli_connect('localhost', 'root', '')){
	 // echo "<script type='text/javascript'> alert('connected');</script>";
	if(@mysqli_select_db($db,'appointment')){
		//  echo "<script type='text/javascript'> alert('selected');</script>";
		// REGISTER USER
	if (isset($_POST['reg_user']))//this if determines if the reg_user button on the registration form is clicked.(submit button  name set to reg_user) 
    {
				//All the data is received from the form and checked to make 
				//sure that the user correctly filled the form. Passwords are also compared to make sure they match.
				
			  // receive all input values from the form
			  $userId = $_POST['userId'];
			//  $role =  $_POST['role'];
			  $password_1 =$_POST['password_1'];
			  $password_2 = $_POST['password_2'];

			  // form validation: ensure that the form is correctly filled
			  if (empty($userId)) { array_push($errors, "UserID is required"); }
			//  if (!isset($_POST['role'])) { array_push($errors, "Role not selected"); }
			  if (empty($password_1)) { array_push($errors, "Password is required"); }
			  if ($password_1 != $password_2) {
			  array_push($errors, "The two passwords do not match");}

		//If no errors were encountered, the user is registered in the users table in the database with a hashed password. 
		//The hashed password is for security reasons to make sure that even if a person 
		//gets access to your database, they would not be able to read your password.

		  // register user if there are no errors in the form
		if (count($errors) == 0) 
		{
			//echo "<script type='text/javascript'> alert(".$userId.");</script>";
			//echo "<script type='text/javascript'> alert(".$password_1.");</script>";
			
			$query = "INSERT INTO login(UserID, Password, Role) 
					  VALUES('$userId', '$password_1', 'Patient')";

			if(mysqli_query($db, $query))
			{
		     echo "<script type='text/javascript'> alert('inserted');</script>";
			//When a user(patient/dentist..) is registered in the database,
			//the system logs them in and redirects them to the fill their details 
			//page.and according to their role pages will be opend

			$_SESSION['userId'] = $userId;
			
		//	 echo "<script type='text/javascript'> alert('welcommmeee');</script>";
			  
		     	header('location: insert_Patient.php');
		      
			}
		}

    }
		// in this code it will check if the user has filled the form correctly,
		// logs them in and then redirects them to the home.php file .

		// LOGIN USER
		if (isset($_POST['login_user'])) {
			
		  //$userId = mysqli_real_escape_string($db, $_POST['userId']);
		  //$password = mysqli_real_escape_string($db, $_POST['password']);
		  
		    $userId = $_POST['userId'];
			//$role=$_POST['role'];
			$password = $_POST['password'];
		  if (empty($userId)) {
			array_push($errors, "UserId is required");
		  }
		  if (empty($password)) {
			array_push($errors, "Password is required");
		  }
		   /*if (!isset($_POST['role'])) {
			   array_push($errors, "Role must be selected"); }
            */
		  if (count($errors) == 0) 
		  {
			//$password = md5($password);
			$query = "select Password,Role from login where UserID='$userId' ";
			
			$results = mysqli_query($db, $query);
			
			//if (mysqli_num_rows($results) == 1) {
				if($results){
					
					$row=mysqli_fetch_array($results);
					
					if ($password==$row['Password'])
					{   //echo "<script type='text/javascript'> alert('welcome');</script>";
					  $_SESSION['userId'] = $userId;
					  $_SESSION['success'] = "You are now logged in";
					 
					 if($row['Role']=="Patient")
					  { header('location: Home.php');}
				  else 
					  if($row['Role']=="Dentist")
					  { 
				        header('location:availabletime.php');
					  }//header to the main page of the dentist
					  
			     else 
					  if($row['Role']=="Admin")
					  { 
				        header('location:manageReceptionist.php');
					  }
					  
				   }
				 	else 
					{
						array_push($errors, "Wrong userId/password combination");
					}
				}else 
				{
					print "".mysql_error( );
				    echo "<script type='text/javascript'> alert('query failed');</script>";
				}
				
		  }
		}
	}else echo "notSelected";
}else echo "not connected"
	


?>