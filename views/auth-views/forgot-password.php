<?php include_once __DIR__.'/../../services/auth-services.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
</head>
<body>
    <form method="post" action="forgot-password">
        <div class="form-group">
        <label for="user-email">Enter your username or Email</label>

        <input id="user-email" type="email" name="usr-email">
        </div>
        <button type="submit" name="pwd-rst">Request New Passwords</button>
    </form>
</body>

<?php
if(isset($_POST['pwd-rst'])){
    if(isset($_POST['usr-email'])){
        reqResetPassword($_POST['usr-email']);
    }else{
        echo `please enter a valid email address or username`;
    }    
}
?>
</html>