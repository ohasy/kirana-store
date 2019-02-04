<?php
$ENV = 'development';
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$_ENV['EMAIL_SENDER_ADDRESS'] = 'email_here'; //FROM MAIL
$_ENV['EMAIL_SENDER_PASS'] = 'password_here';

if($ENV == 'development') {
    
    $_ENV['ROOT'] = '/kirana-store';
    $_ENV['DB_HOST'] = 'localhost';
    $_ENV['DB_NAME'] = 'apnadb';
    $_ENV['DB_USER'] = 'root';
    $_ENV['DB_PASS'] = '';
    $_ENV["IMGPATH"] = $protocol.$_ENV['DB_HOST'].$_ENV['ROOT'] .'/uploads/';
} else {
    $_ENV['ROOT'] = 'kirana-store';
    $_ENV['DB_HOST'] = 'somedomain.com';
    $_ENV['DB_NAME'] = 'apnadb';
    $_ENV['DB_USER'] = 'root';
    $_ENV['DB_PASS'] = '';
    $_ENV["IMGPATH"] = $_ENV['DB_HOST'].$_ENV['ROOT'] .'/uploads/';
}


?>
