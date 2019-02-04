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
<?php subview('header.php'); 

$showAlert = false;
$alertMsg = "";
 

if(isset($_POST['reg_user'])){
	$res = registerUser($_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['username'],$_POST['password_1'],$_POST['password_2']);
	// var_dump($res);
	if (array_key_exists("errors", $res)){

		$errors = '';
		foreach($res['errors'] as $err  ){
			$errors.= ' '.$err.',';
		}
		
		$alertMsg = $errors;
		$alertType = 0;
		$showAlert = true;

		// var_dump($res['errors']);
	} else if(array_key_exists("success", $res)){
		// var_dump($res['success']);
	 header("Location:"."../home-views/home.php");
	}
}

?>
<section class="d-flex mt-5 justify-content-center align-items-center" id="main">
<div class="container col-lg-6 col-sm-12">
    <div class="header text-center mb-3">
        <h2>Sign up</h2>
    </div>
	
  <form method="post" action="register.php">
		<!-- <?php include('errors.php'); ?> -->
		
  	<div class="form-group">
  	  <input class="form-control" placeholder="First Name" type="text" name="fname" value="<?php 'echo $username;' ?>">
  	</div>
		<div class="form-group">
  	  <input class="form-control" placeholder="Last Name" type="text" name="lname" value="<?php 'echo $username;' ?>">
  	</div>
  	<div class="form-group">
  	  <input class="form-control" placeholder="Username" type="text" name="username" value="<?php 'echo $email;' ?>">
  	</div>
		<div class="form-group">
  	  <input class="form-control" placeholder="Email" type="email" name="email" value="<?php 'echo $email;' ?>">
  	</div>
  	<div class="form-group">
  	  <input class="form-control" placeholder="Password" type="password" name="password_1">
  	</div>
  	<div class="form-group">
  	  <input class="form-control" placeholder="Confirm password" type="password" name="password_2">
		</div>
		<?php if($showAlert == true) showAlertMessage($alertMsg,$alertType); ?>
  	<div class="form-group w-100 mt-4">
  	  <button type="submit" class="btn btn-primary w-100" name="reg_user">Register</button>
  	</div>
  	<p class="text-center" > 
  		Already a member? <a href="login">Sign in</a>
		</p>
		

	</form>
	</div>
</section>
	<?php subview('footer.php'); ?>
</body>

