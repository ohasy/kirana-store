# kirana-store

Another garib ecommerce website in core php. So, you have choosen php for your college summer training ? and now looking for the code to throw at your prof desk. here it is.

# tools used:

- php
- mysql
- bootstrap 4
- jquery

## steps to setup:

1. Install Xampp.
2. create a db in phpmyadmin.
3. Import apnadb.sql to that db for tables generations. migrations lol.
4. put this in project code in htdocs of xampp, after installing xamp obviously.

## project structure:

It will change again I am sure. so no point in documenting that right now.

## TASKS:

- project structure : decide what goes where -- DONE
- make product and categories crud services -- DONE
- login and register with pass hashes. --DONE
- send mails with zipped attachments through phpmailer --DONE
- forget password functionality with password reset tokens --WORKING
- make jwt token based rest api for login/sign up and everything else.
- figure out a way to show good urls
- use ajax calls somewhere in the app.

## TABLE ALTERS COMMANDS:

ALTER TABLE `pwd_reset_tokens` CHANGE `resert_token` `reset_token` VARCHAR(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

// TODO:: FORGOT PASS LOGIC::
// MAKE A BUTTON 'forgot password' in views/auth-views/login.php
// send a mail to user's email address with a link to change password
// two pass fields which will reset the password
// hash
