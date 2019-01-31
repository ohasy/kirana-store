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
$alertClass = ($type == 1 ) ? 'alert-success' : 'alert-danger';

$alertText =<<<alert
<div class="d-flex mt-3 w-100 justify-content-center align-items-center">
	<div class="alert $alertClass" role="alert">$text</div>
</div>
alert;
echo $alertText;
}

function showArray($array) {

		echo "<pre>";
		print_R($array);
}