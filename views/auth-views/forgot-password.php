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
<?php 
subview('header.php');
$showAlert = false;
if(isset($_POST['pwd-rst'])){
    if(isset($_POST['usr-email'])){
        $result = reqResetPassword($_POST['usr-email']);

        if(array_key_exists("success",$result)){
               header('Location:enter-otp.php');
               showAlertMessage($result['success'],1);
            // echo("<script>location.replace = '/enter-otp';</script>");
        }else {
            $showAlert = true;
            $alertType = 0;
            $alertMsg = $result['error'];
            
        }
    }else{
        showAlertMessage(`please enter a valid email address or username`,0) ;
    }    
}
?>


<div class="container-fluid h-100 d-flex bg-info justify-content-center align-items-center">
<div class="col-lg-6 bg-light">
    <div class="header bg-light text-center">
        <h2 class="text-light text-info">Forgot password</h2>
    </div>
        <div class="container p-5">
            <form method="post" action="forgot-password">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@</span>
                    </div>
                    <input type="text"  name="usr-email" class="form-control" placeholder="enter your username or email" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <!-- <div class="form-group">
                    <label for="user-email">Enter your username or Email</label>
                    <input id="user-email" class="form-control" type="text" name="usr-email">
                </div> -->
                <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" name="pwd-rst">Request New Passwords</button>
                </div>
                <?php 
                if($showAlert){
                    showAlertMessage($alertMsg,$alertType);
                }
                ?>
            </form>
            <div class="w-100 d-flex mt-3 justify-content-center align-items-center">
            <p> Already have otp? <a href="enter-otp">Enter Otp</a></p>
            </div>
        </div>
    </div>
</div>
    <?php subview('footer.php'); ?> 
</body>


</html>