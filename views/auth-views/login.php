<?php include_once __DIR__.'/../../services/auth-services.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
<?php subview('header.php'); ?>

<section class="d-flex mt-5 justify-content-center align-items-center" id="main">
    <div class="container col-lg-6 col-sm-12">
    <div class="header text-center">
        <h2>Get in</h2>
    </div>
    <form method="post" action="login.php">
    
        <div class="form-group">
            <label>Username or email</label>
            <input class="form-control" type="text"  name="username" >
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="password">
        </div>
        <div class="form-group w-100 mt-4">
            <button class="btn btn-primary w-100" type="submit" class="btn" name="login_user">Login</button>
        </div>
        <p>
             <a href="forgot-password">Forgot credentials?</a>
        </p>
        <p>
            Not yet a member? <a href="register">Sign up</a>
        </p>
    </form>
    </div>
</section>
<?php subview('footer.php'); ?> 
</body>
</html>


<?php 
    if(isset($_POST['login_user'])){
        // echo('post pass'.$_POST['password']);
        $username = $_POST['username'];
        $pass = $_POST['password'];
        // echo('passs'.$pass);
        loginUser($username,$pass);
    }
?>