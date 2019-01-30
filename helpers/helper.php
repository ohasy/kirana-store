<?php
function subview($file){
	$file = __DIR__.'/../views/sub-views/'.$file;
	include $file;
}

function resetPassEmailBody($fname,$reset_token_otp){
$host = $_SERVER['HTTP_HOST'];
$body=<<<body
<h1>Kirana Store</h1>
<h3> Hello $fname, </h3>
<br>

<p> Looks like you have requested to change password.</p>
<h3 style="color:blue;">OTP</h3>
<h3 style="color:blue;">$reset_token_otp</h3>
<p> if it was not you then change your password and make it stronger.</p>


body;

return $body;
}

function showAlertMessage($text,$type = 0) {
// 0 for fail
// 1 for success
$alertClass = ($type == 'success' || $type == 1 ) ? 'alert-success' : 'alert-danger';
$alertText =<<<alert
<div class="col-6 alert $alertClass" role="alert">
$text
</div>
alert;
echo $alertText;
}