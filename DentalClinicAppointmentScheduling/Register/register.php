<?php include('server.php') ?>

<html>
<head>
  <title>Registration for appointo website</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>UserId</label>
  	  <input type="text" name="userId" value="<?php echo $userId; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Role</label>
	  <select name="role">
		  <option value="Patient">Patient</option><!-- bas patient by3ml register login admin recep or dentist--->
	  </select>
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>