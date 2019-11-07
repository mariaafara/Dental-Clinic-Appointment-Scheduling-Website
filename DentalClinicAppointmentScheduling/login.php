<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>UserId</label>
  		<input type="text" name="userId" >
  	</div>
	<!--  <div class="input-group">
  	 <label>Role</label>
	  <select name="role">
		  <option  value="Patient">Patient</option>
		  <option  value="Dentist">Dentist</option>
		  <option  value="Receptionist">Receptionist</option>
		  <option  value="Admin">Admin</option>

	  </select>
  	</div>-->
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
	
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>