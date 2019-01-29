<?php
  include_once __DIR__."/../helpers/init.php";

  // Logic : 
  // proceed if email and username is not used. 
  // hash the password. 
  // store the details and hashed password in db.
  // role id: 0 : user, 1: admin. 2: venderor
  // save details in session
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
      var_dump($result);
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

      $errors = array();
      $username = mysqli_real_escape_string($GLOBALS['con'], $_username);
      // $pass = mysqli_real_escape_string($GLOBALS['con'], $_password);
      // echo('<br>pass'.$pass);
      if (empty($username)) {
          array_push($errors, "Username is required");
      }
      if (empty($pass_word)) {
          array_push($errors, "Password is required");
      }
  
      if (count($errors) == 0) {
          // $password = password_hash($password);
          $loginQuery = "SELECT `id`,`f_name`,`l_name`,`username`,`password`,`role_id` FROM `users` WHERE `username`=?";
          $stmt = $GLOBALS['con']->prepare($loginQuery);

          if($stmt) {

                $stmt->bind_param("s", $username);
                $stmt->execute();
                $stmt->bind_result($user_id, $fname, $lname, $username, $password, $role);
                $row =$stmt->fetch();
                // echo $_password;
                echo $user_id.' '.$fname.' '.$lname.' '.$username.' '.$pass_word.' '.$password.' '.$role; 
                var_dump(password_verify($pass_word, $password));
                if (!empty($row)) {
                  
                    if (password_verify($pass_word, $password)) {
                        session_start();
                        $_SESSION['username']= $username;
                        $_SESSION['is_authenticated'] = true;
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['is_admin'] = false;
                        $_SESSION['role'] = $role;

                        echo 'user logged in';
                        header('Location:../home.php');
                        
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

?>