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

if(isset($_POST['otp-send'])){
    if(isset($_POST['otp-inpt']) && !empty($_POST['otp-inpt'])){
        $result = submitOTP($_POST['otp-inpt']);

        if(array_key_exists("success",$result)){
                $user_id = $result['success'];

             header('Location:reset-password');
               
            // echo("<script>location.replace = '/enter-otp';</script>");
        }else {
            $showAlert = true;
            $alertType = 0;
            $alertMsg = $result['error'];
            
        }
    }else{
        $showAlert = true;
        $alertType = 0;
        $alertMsg = 'Please Enter Some value';
    }    
}
?>


<div class="container-fluid h-100 d-flex bg-info justify-content-center align-items-center">
<div class="col-lg-6 bg-light">
    <div class="header bg-light text-center">
        <h2 class="text-light text-info">Forgot password</h2>
    </div>
        <div class="container p-5">
            <form method="post" action="enter-otp">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">OTP</span>
                    </div>
                    <input type="numeric"  name="otp-inpt" class="form-control" placeholder="enter otp you have received in your mail" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <!-- <div class="form-group">
                    <label for="user-email">Enter your username or Email</label>
                    <input id="user-email" class="form-control" type="text" name="usr-email">
                </div> -->
                <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" name="otp-send">Send</button>
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