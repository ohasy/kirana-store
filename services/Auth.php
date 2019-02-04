<?php

class AuthController  {

    function registerUser($_fname,$_lname,$_email,$_username,$_password1,$_password2):array {
        $errors = array(); 
        $fname = mysqli_real_escape_string($GLOBALS['con'],$_fname);
        $lname = mysqli_real_escape_string($GLOBALS['con'],$_lname);
        $email = mysqli_real_escape_string($GLOBALS['con'],$_email);
        $username = mysqli_real_escape_string($GLOBALS['con'],$_username);
        $password1 = mysqli_real_escape_string($GLOBALS['con'],$_password1);
        $password2 = mysqli_real_escape_string($GLOBALS['con'],$_password2);
    
        if (empty($username)) { array_push($errors, "Username is required"); }
        if (empty($email)) { array_push($errors, "Email is required"); }
        if (empty($password1)) { array_push($errors, "Password is required"); }
        if ($password1 != $password2) {
        array_push($errors, "The two passwords do not match");
        }
    
        $user_check_query = "SELECT * FROM `users` WHERE `username`='$username' OR email='$email' LIMIT 1";
        $result = mysqli_query($GLOBALS['con'],$user_check_query);
        $user = mysqli_fetch_assoc($result);
    
        if ($user) { // if user exists
          if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
          }
      
          if ($user['email'] === $email) {
            array_push($errors, "email already exists");
          }
        }
    
        if(count($errors) == 0) {
          $password = password_hash($password1,PASSWORD_BCRYPT);
    
          $insertQuery = "INSERT INTO `users` (`f_name`,`l_name`,`username`,`email`,`password`) VALUES (?,?,?,?,?)";
          $stmt = $GLOBALS['con']->prepare($insertQuery);
          $stmt->bind_param("sssss",$fname,$lname,$username,$email,$password);
          $result = $stmt->execute();
          $insert_id = $stmt->insert_id;
          $stmt->close();
          // var_dump($result);
          if($result){
            session_start();
            $_SESSION['username']= $username;
            $_SESSION['is_authenticated'] = true;
            $_SESSION['user_id'] = $insert_id;
            $_SESSION['is_admin'] = false;
            $_SESSION['role'] = 0;
            
            return array("success"=>true);
          }else {
            return array("errors"=>"something went wrong");
          }
        } else {
          return array("errors"=>$errors);
        }
    
      }
    
      // Logic :
      // proceed if email matched,
      // get hashed password from db
      // verify password
      // then check if hash of the password is matched with store password.
      // if so, store : id,f_name,l_name,username,role,username in session
    
      function loginUser(string $_username,string $pass_word)
      {
          session_start();
    
          $errors = array();
          $username = mysqli_real_escape_string($GLOBALS['con'], $_username);
          $password = mysqli_real_escape_string($GLOBALS['con'], $pass_word);
          // echo('<br>pass'.$pass);
          if (empty($username)) {
              array_push($errors, "Username is required");
          }
          if (empty($password)) {
              array_push($errors, "Password is required");
          }
      
          if (count($errors) == 0) {
              // $password = password_hash($password);
              $loginQuery = "SELECT `id`,`f_name`,`l_name`,`username`,`password`,`role_id` FROM `users` WHERE `username`=?";
              $stmt = $GLOBALS['con']->prepare($loginQuery);
    
              if($stmt) {
    
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $stmt->bind_result($user_id, $fname, $lname, $username, $pass_hash, $role);
                    $row =$stmt->fetch();
                    // echo $_password;
                    // echo $user_id.' '.$fname.' '.$lname.' '.$username.' '.$password.' '.$pass_hash.' '.$role; 
                    var_dump(password_verify($password, $pass_hash));
                    if (!empty($row)) {
                      
                        if (password_verify($password, $pass_hash)) {
                           
                            $_SESSION['username']= $username;
                            $_SESSION["fname"] = $fname;
                            $_SESSION['lname'] = $lname;
                            $_SESSION['is_authenticated'] = true;
                            $_SESSION['user_id'] = $user_id;
                            $_SESSION['is_admin'] = false;
                            $_SESSION['role'] = $role;
    
                            echo 'user logged in';
                            if($role == 0) {
                              header('Location:../home.php');
                            } else if($role == 1) {
                              header('Location:../dashboard.php');
                            }
                            
                            
                        } else {
                            echo 'hash nhi match ho rha login failed';
                        }
                    } else {
                      echo 'user does not exist';
                    }
          
                    $stmt->close();  
    
              } else {
                $error = $GLOBALS['con']->errno . ' ' . $GLOBALS['con']->error;
                echo $error;
                
              }
    
            
    
          } else {
            var_dump($errors);
          }
      }
    
      // will get user_id :
      // make an entry of reset token in pwd_reset_tokens table with user_id
      // make a reset link containing this token
      // mail it to user's email address 
      function reqResetPassword($user_email){
    
        $queryGetUsrId = "SELECT `id`,`f_name`,`email` FROM `users` WHERE `username`=? OR `email`=? ";
        $stmt = $GLOBALS['con']->prepare($queryGetUsrId);
        $stmt->bind_param("ss",$user_email,$user_email);
        $stmt->execute();
        $stmt->bind_result($user_id,$fname,$email);
        $row = $stmt->fetch();
        $stmt->close();
        if (!empty($row)) {
            return addResetToken($user_id,$fname,$email);
        } else {
          return array("error"=>"User does not exists");
        }
      
      }
    
      // GET USER MAIL FROM USER ID
      // SEND MAIL WITH A 6 DIGIT OTP
    
      function addResetToken($user_id,$fname,$email):array{
      
        $reset_token_otp = mt_rand(100000, 999999);
        $qryInsrtRstTkn = "INSERT INTO `pwd_reset_tokens` (`user_id`,`reset_token`) VALUES(?,?)";
        $stmt = $GLOBALS['con']->prepare($qryInsrtRstTkn);
        $stmt->bind_param("is",$user_id,$reset_token_otp);
        $result = $stmt->execute();
    
        if($stmt) {
    
          $insert_id = $stmt->insert_id;
          $stmt->close();
      
          if($result){
    
            $body = resetPassEmailBody($fname,$reset_token_otp);
            $mailResult = sendMail("Reset your password",$body,$email);
            
            if(array_key_exists("error",$mailResult)){
          
              return array("error"=>$mailResult['error']);
               
            } else {
    
              return array("success"=>$mailResult['success']);
              
            }
            
          }else{
            return array("error"=>"Cant save new otp to db");
          }
    
        } else {
            $error = $GLOBALS['con']->errno . ' ' . $GLOBALS['con']->error;
            return array("error"=>$error);
            
        }
    
      }
    
      // GET 6 DIGIT OTP 
      // SET USER SESSION TO BE ABLE TO CHANGE PASSWORD
      
      function submitOTP($otp) {
        $qrySbtOTP = 'SELECT `user_id` FROM `pwd_reset_tokens` WHERE `reset_token`=?';
        $stmt = $GLOBALS['con']->prepare($qrySbtOTP);
        $stmt->bind_param("s",$otp);
        $stmt->execute();
        $result = $stmt->get_result();
        if($stmt) {
          $stmt->close();
          if($result->num_rows) {
    
            while($row = mysqli_fetch_assoc($result)){
      
              if(!empty($row)) {
      
                session_start();
                $_SESSION['reset_password'] =true;
                $_SESSION['user_id'] = $row['user_id'];
                // var_dump($_SESSION);
                  
                // return array("error"=>'Wait kar bhai');
                return array("success"=>$row['user_id']);
            }else {
                return array("error"=>'Incorrect OTP');
              }
            }
      
          }else {
            return array("error"=>'Incorrect OTP');
          }
        } else {
          $stmt->close();
          $error = $GLOBALS['con']->errno . ' ' . $GLOBALS['con']->error;
          return array("error"=>$error);
        }
    
    
        
      }
    
      // RESET PASSWORD WITH NEW PASSWORD
    
      function resetPass($user_id,$pass1,$pass2):array{
        $password1 = mysqli_real_escape_string($GLOBALS['con'],$pass1);
        $password2 = mysqli_real_escape_string($GLOBALS['con'],$pass2);
        $errors = array();
        if (empty($password1) || empty($password2)) { 
          array_push($errors, "Password fields are required"); }
        if ($password1 != $password2) {
          array_push($errors, "The two passwords do not match");
        }
    
        if(count($errors) != 0){
          return array("error"=>$errors);
        }
        $pass_hash = password_hash($password1,PASSWORD_BCRYPT);
        // $user_id = $_SESSION['user_id'];
        $GLOBALS['con']->autocommit(FALSE);
        $qryChngPass = "UPDATE `users` SET `password`=? WHERE `id`=? ";
        $stmt = $GLOBALS['con']->prepare($qryChngPass);
        $stmt->bind_param("si",$pass_hash,$user_id);
        $stmt->execute();
    
        $qryDelRstTkn = "DELETE FROM `pwd_reset_tokens` WHERE `user_id`=?";
        $stmt2 = $GLOBALS['con']->prepare($qryDelRstTkn);
        $stmt2->bind_param("i",$user_id);
        $stmt2->execute();
    
        $GLOBALS['con']->commit();
        $GLOBALS['con']->autocommit(TRUE);
    
        if($stmt) {
          
          $stmt->close();
          session_destroy();
          return array("success"=>"Password has been changed successfully");
        }else {
          $stmt->close();
          $error = $GLOBALS['con']->errno . ' ' . $GLOBALS['con']->error;
          return array("error"=>array($error));
        }
    
      }

} 

?>