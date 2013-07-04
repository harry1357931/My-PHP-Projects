<?php              // This file will pack together the folders: database and functions

   session_start();
   
   require 'database/connect.php';       // Including connect.php from database folder
   require 'functions/general.php';
   require 'functions/users.php';        // Including users.php from database folder
   // $current_file variable is used in: when we force the user to change password...when user first login after recovery of password.
   $current_file = explode('/', $_SERVER['SCRIPT_NAME']);
   $current_file = end($current_file);       // end() will take the last element of an array (array here is formed by exploding)....$_SERVER['SCRIPT_NAME'] is like localhost/mysite/reg&login/recover.php
   
  if(logged_in() === true) {
       $session_user_id = $_SESSION['user_id'];
       $user_data = user_data($session_user_id, 'user_id', 'username', 'password' ,'first_name' ,'last_name', 'email', 'password_recover', 'type', 'allow_email');
       // In the above statement , u can pass any no. of variables u need...leave out the extra stuff.
       // echo $user_data['username'];         // it will print harry only then.

      if(user_active($user_data['username'])=== false){     // if user is not active then do this...
      
          session_destroy();
          header('Location: index.php');
          exit();

		} // if loop ends here
	  // Though every widget like profile, settings etc. contain init.php....but this will not lead to infinite loop.o
	  // This is for forced changed password cases--- See Video no. 38 near the end(after 2/3rd of video--for explanation)
      // init file is included in changepassword.php --- So $current_file should not be equal to 'changepassword.php' (to go into if loop)....as it will lead to infinite loop....
	  if( $current_file !== 'changepassword.php' && $user_data['password_recover'] == 1){
	  
	      header('Location: changepassword.php?force');         // ?force  -- will be used in changepassword.php...to display a specific message
	      exit();
	   }	   
   
   }
   
   $errors = array();

?>