<?php include_once __DIR__.'/../../services/auth-services.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
<?php subview('header.php'); ?>
<div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>First Name</label>
  	  <input type="text" name="fname" value="<?php 'echo $username;' ?>">
  	</div>
		<div class="input-group">
  	  <label>Last Name</label>
  	  <input type="text" name="lname" value="<?php 'echo $username;' ?>">
  	</div>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php 'echo $email;' ?>">
  	</div>
		<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php 'echo $email;' ?>">
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
  		Already a member? <a href="login">Sign in</a>
  	</p>
  </form>
	<?php subview('footer.php'); ?>
</body>

  <?php 
  if(isset($_POST['reg_user'])){
		$res = registerUser($_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['username'],$_POST['password_1'],$_POST['password_2']);
		// var_dump($res);
		if (array_key_exists("errors", $res)){
			foreach($res['errors'] as $err  ){
				echo '<p>'.$err.'</p>';
			}
			// var_dump($res['errors']);
		} else if(array_key_exists("success", $res)){
			// var_dump($res['success']);
		 header("Location:"."views/home.php");
		}
  }
  
  ?>