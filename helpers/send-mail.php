<?php 
include_once __DIR__.'/../libs/class.phpmailer.php';

function sendMail(string $subject,string $body,array $recipients,array $attachments = array() ):array{
    //from :
    $mailer = new PHPMailer();
$mailer->IsSMTP();
$mailer->Host = "smtp.gmail.com";
$mailer->Port = 587;
$mailer->SMTPSecure = "tls";
$mailer->SMTPAuth = true;
$mailer->Username = 'airbnbbikaner@gmail.com';
$mailer->Password = "wow@2018";
$mailer->Subject =$subject;
$mailer->Body = $body;
$mailer->IsHTML(true);
$mailer->AddAddress($to,"yash");



foreach($recipients as $email => $name){
$mailer->AddAddress($email,$name);
}
// $mailer->AddAddress('rahul@sharabhtechnologies.com','rahul');
// $mailer->AddAddress("anuraj.7627@gmail.com","anuraj");
if(isset($attachments) && count($attachments)>0) {
    foreach($attachments as $file_path => $file_name){
        $mailer->AddAttachment($file_path,$file_name);
        }
}
else {
    echo '<script>alert("fir bhi nhi aya");</script>';
}
// $mailer->AddAttachment('file.zip','libs.zip');
// $mailer->AddAttachment('forgot.php','file.php');
$mailer->From = 'airbnbbikaner@gmail.com';
$mailer->FromName = 'puchi';


if(!$mailer->Send()){

    return array("error"=>$mailer->ErrorInfo);

//   echo "Mailer Error: " . $mailer->ErrorInfo;
}else{
    return array("success"=>"mail has been sent");
//   echo 'gyo';
}

}
?>