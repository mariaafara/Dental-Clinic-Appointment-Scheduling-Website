<?php 
  session_start(); 
//The first if statement checks if the user is already logged in. If they are not logged in, they will be 
//redirected to the login page. Hence this page is accessible to only logged in users. 

  if (!isset($_SESSION['userId'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  
  //this if  checks if the user has clicked the logout button. 
  //If yes, the system logs them out and redirects them back to the login page.
  
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['userId']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['userId'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['userId']; ?></strong></p>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
		
</body>
</html>