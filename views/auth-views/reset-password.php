<?php include_once __DIR__.'/../../services/auth-services.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enter Otp</title>
</head>
<body>
<?php 
subview('header.php');
$showAlert = false;
session_start();

// To check if user can go to password reset page :

// If not
if(!isset($_SESSION['user_id']) || $_SESSION['reset_password'] != true){
    $showAlert = true;
    $alertType = 0;
    $alertMsg = `safd`;

     header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
     header('Location:login');
  
}  else {
    // reset passwords function call

    if(isset($_POST['rst-pwd'])) {
        if(isset($_POST['password1'] ) && isset($_POST['password2']) ){

            $password1 = $_POST['password1'];
            $password2 = $_POST['password2'];
            $user_id = $_SESSION['user_id'];
            $result = resetPass($user_id,$password1,$password2);
            showArray($result);
            if(array_key_exists("error",$result)){

                $errors = $result['error'];

                foreach($errors as $err){
                    $alertMsg .= ' '.$result['error'];
                }
              
                $alertType = 0;
                $showAlert = true;
            }else {
                 header('Location:login');
            }

        } else {
            $alertType = 0;
            $alertMsg = "Fields can not be left empty";
            $showAlert = true;
        }
    }

}

?>


<div class="container-fluid h-100 d-flex bg-info justify-content-center align-items-center">
<div class="col-lg-6 col-sm-12 bg-light">
    <div class="header bg-light text-center">
        <h2 class="text-light text-info">Forgot password</h2>
    </div>
        <div class="container p-5">
            <form method="post" action="reset-password">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">**</span>
                    </div>
                    <input type="password"  name="password1" class="form-control" placeholder="enter new password" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">**</span>
                    </div>
                    <input type="password"  name="password2" class="form-control" placeholder="confirm password" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <!-- <div class="form-group">
                    <label for="user-email">Enter your username or Email</label>
                    <input id="user-email" class="form-control" type="text" name="usr-email">
                </div> -->
                <div class="d-flex w-100 justify-content-center">
                <button type="submit" class="btn w-100 btn-primary" name="rst-pwd">Reset Password</button>
                </div>
                <?php 
                if($showAlert == true){
                    showAlertMessage($alertMsg,$alertType);
                }
                ?>
            </form>
        </div>
    </div>
</div>
    <?php subview('footer.php'); ?> 
</body>


</html>