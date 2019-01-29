<?php include_once __DIR__.'/../../services/auth-services.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php subview('header.php'); ?>

<section id="main">
    <div class="header">
        <h2>Login</h2>
    </div>
    <form method="post" action="login.php">

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" >
        </div>
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