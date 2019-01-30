<?php 
include_once __DIR__.'/../libs/class.phpmailer.php';

function sendMail(string $subject,string $body, $recipients,array $attachments = array() ):array{
    //from :
    $mailer = new PHPMailer();
$mailer->IsSMTP();
$mailer->Host = "smtp.gmail.com";
$mailer->Port = 587;
$mailer->SMTPSecure = "tls";
$mailer->SMTPAuth = true;
$mailer->Username = $_ENV['EMAIL_SENDER_ADDRESS'];
$mailer->Password = $_ENV['EMAIL_SENDER_PASS'];
$mailer->Subject =$subject;
$mailer->Body = $body;
$mailer->IsHTML(true);
//when multiple emails
if(gettype($recipients) == "array") {

    foreach($recipients as $email){
        $mailer->AddAddress($email);
    }

} else {
    $mailer->AddAddress($recipients);
}


if(isset($attachments) && count($attachments)>0) {
    echo 'ye execute hua'.$attachments;
    foreach($attachments as $file_path => $file_name){
        $mailer->AddAttachment($file_path,$file_name);
        }
}

$mailer->From = $_ENV['EMAIL_SENDER_ADDRESS'];
$mailer->FromName = 'Kirana Store';


if(!$mailer->Send()){

    return array("error"=>$mailer->ErrorInfo);

//   echo "Mailer Error: " . $mailer->ErrorInfo;
}else{
    return array("success"=>"mail has been sent");
//   echo 'gyo';
}

}
?>