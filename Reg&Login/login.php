<?php                     // Log in file in the main folder
  include 'core/init.php';
  logged_in_redirect();

  if( empty($_POST)=== false ) {

     $username= $_POST['username'];
     $password= $_POST['password'];

     if( empty($username)=== true || empty($password)=== true ) {

         $errors[]= 'You need to enter a username and a password.';
     }
     else if(user_exists($username)=== false) {                               // user_exists(...) .....self defined function
         $errors[]= 'We can\'t find that username...Have you registered ?';
     }
     else if(user_active($username)===false){
        $errors[]= 'You haven\'t activated ur account !';
     }
     else {                                                                // #1
           if(strlen($password) > 32) {
               $errors[] = 'Password is too long....Please enter a valid password!';
           }

          $login = login($username, $password);
          if($login === false ){
              $errors[] = 'The username and password combination is incorrect!';
          }
          else {
                  // set the user session
                  $_SESSION['user_id'] = $login;

                  // redirect user to home
                  header('Location: index.php');
                  exit();

          }// Most recent else ends here
     }  // #1 ends here

                //print_r($errors);     // use this function only to print errors...not needed now...becoz of some other modification.

   }  // if( empty($_POST)=== false )......following if loop ends here
   else {                                       // #2

     $errors[] = 'User data can\'t received....because may be user forgot to enter username or password or some other fault';
  }     // #2 ends here

  include 'includes/overall/overallheader.php';
  
  if(empty($errors)===false){
  ?>
     <h2>We tried to log you in, but...</h2>
  <?php
   echo output_errors($errors);
  } // if loop ends here



  include 'includes/overall/overallfooter.php';

  ?>



