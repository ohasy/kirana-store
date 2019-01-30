
<?php
include_once 'libs/class.phpmailer.php';
include('db.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
 

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="style.css">
</head>
<body>



<?php
session_start();
include_once 'db.php';
//http://www.inmotionhosting.com/support/files/downloads/PHPMailer_5.2.0.zip
//https://www.inmotionhosting.com/support/email/send-email-from-a-page/using-phpmailer-to-send-mail-through-phphttps://www.inmotionhosting.com/support/email/send-email-from-a-page/using-phpmailer-to-send-mail-through-php
$body = <<<body
<h1> the code of the phpmailer</h1>
<p>libs folder contains the phpmailer file</p>
body;

$zip = new ZipArchive();

// Get real path for our folder
$rootPath = realpath('libs');

// Initialize archive object
$zip = new ZipArchive();
$zip->open('file.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}

// Zip archive will be created only after closing object
$zip->close();


$mailer = new PHPMailer();
$mailer->IsSMTP();
$mailer->Host = "smtp.gmail.com";
$mailer->Port = 587;
$mailer->SMTPSecure = "tls";
$mailer->SMTPAuth = true;
$mailer->Username = 'airbnbbikaner@gmail.com';
$mailer->Password = "wow@2018";
$mailer->Subject ='PHP MAILER AND ZIP CODE';
$mailer->Body = $body;
$mailer->IsHTML(true);
$mailer->AddAddress("yash@sharabhtechnologies.com","yash");
$mailer->AddAddress('rahul@sharabhtechnologies.com','rahul');
$mailer->AddAddress("anuraj.7627@gmail.com","anuraj");
$mailer->AddAttachment('file.zip','libs.zip');
$mailer->AddAttachment('forgot.php','file.php');
$mailer->From = 'airbnbbikaner@gmail.com';
$mailer->FromName = 'puchi';


if(!$mailer->Send()){
  echo "Mailer Error: " . $mailer->ErrorInfo;
}else{
  echo 'gyo';
}



if(isset($_POST['submit']))
{
    $username = $_POST['userName'];
    $result = mysqli_query($conn,"SELECT * FROM `register` where userName='" . $_POST['usename'] . "'");
    $row = mysqli_fetch_assoc($result);
	$fetch_user_id=$row['userName'];
	$email=$row['userEmail'];
	$password=$row['password'];
	if($username==$fetch_username) {
				$to = "";
                $subject = "Password";
                $txt = "Your password is : $password.";
                $headers = "From: " . "\r\n" .
                "CC: ";
                mail($to,$subject,$txt,$headers);
			}
				else{
					echo 'invalid userid';
				}
}
?>















<form class="form-signin" method="POST" action="controller.php">
        <h2 class="form-signin-heading">Forgot Password</h2>
        <div class="input-group">
	  <input type="text" name="userName" class="form-control" placeholder="Username" required>
	</div>
	<br />
        <button class="btn btn-lg btn-primary btn-block"  type="submit" name="forgot">Forgot Password</button>
        <a class="btn btn-lg btn-primary btn-block" href="login.php">Login</a>
      </form>
    
</body>
</html>