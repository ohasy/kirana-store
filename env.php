<?php
$ENV = 'development';

$_ENV['EMAIL_SENDER_ADDRESS'] = 'yashojha55@gmail.com'; //FROM MAIL
$_ENV['EMAIL_SENDER_PASS'] = 'phpmailer@123';

if($ENV == 'development') {

    $_ENV['DB_HOST'] = 'localhost';
    $_ENV['DB_NAME'] = 'apnadb';
    $_ENV['DB_USER'] = 'root';
    $_ENV['DB_PASS'] = '';
} else {

    $_ENV['DB_HOST'] = 'somedomain.com';
    $_ENV['DB_NAME'] = 'apnadb';
    $_ENV['DB_USER'] = 'root';
    $_ENV['DB_PASS'] = '';
}

?>