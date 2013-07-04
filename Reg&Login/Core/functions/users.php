<?php

  function mail_users($subject, $body){
      
      $query = mysql_query("SELECT `email`, `first_name` FROM `users` WHERE `allow_email`= 1");
      while ( ($row = mysql_fetch_assoc($query)) !== false ){
	  
		   email($row['email'], $subject, "Hello " . $row['first_name'] . ",\n\n" . $body); 		   
	   }	  
  
   }
  
  function has_access($user_id, $type) { 
      $user_id = (int)$user_id;
	  $type    = (int)$type;
	  return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `user_id` = $user_id AND `type`= $type"), 0) == 1) ? true : false;
  
   }
  
  
  function recover($mode, $email){                     // Value of mode is either username or password depending on user...what he/she wants to recover.
      $mode  = sanitize($mode);
      $email = sanitize($email);
	  
	  $user_data = user_data(user_id_from_email($email), 'user_id', 'first_name', 'username');
	  
	  if($mode == 'username'){
	       email($email, 'Your username', "Hello " . $user_data['first_name'] . ",\n\nYour username is: " . $user_data['username'] . ".\n\n--phpacademy");
	  }
	  else if($mode == 'password'){
	       $generated_password = substr(md5(rand(999, 999999)), 0, 8);           // generated a new password...and will update it in user's profile and then email him, also forced user to change their password after their first login...constantly redirecting them to change password page, we gonna use password_recover column for that.
	       change_password($user_data['user_id'], $generated_password);
		   // Updating password_recover field from 0 to 1 after changing password, now we will force user to change password until password_recover field is 1, after changed by user, we will again set it to 0.
		   update_user($user_data['user_id'], array('password_recover' => '1')); 
		   email($email, 'Your password recovery', "Hello " . $user_data['first_name'] . ",\n\nYour new password is: " . $generated_password . ".\n\n--phpacademy");
		   
	   }
      
   }
   
  function update_user($user_id, $update_data) {
        
		$update = array();
		array_walk($update_data, 'array_sanitize');                 // for sanitizing the whole array
		
		foreach($update_data as $field=>$data){
		
		  $update[] = '`' . $field . '` = \'' . $data . '\''; 
		}
		
		mysql_query("UPDATE `users` SET " . implode(', ', $update) . "WHERE `user_id` = $user_id");
		
    } // function update_user ends here...
 
  
  function activate($email, $email_code){
      $email      =  mysql_real_escape_string($email);   
      $email_code =  mysql_real_escape_string($email_code);
	  
	  $query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email' AND `email_code` = '$email_code' AND `active` = 0");
	  if(mysql_result($query, 0) == 1){   // == 1 means mysql_result($query,0) is 1...or we can say COUNT is 1 where email and email_code matches. 
	    
		mysql_query("UPDATE `users` SET `active` = 1 WHERE `email` = '$email'");   // query to update user active status to 1
	    return true;
	  }
	  else{
	    return false;
	  }
  
  }
  
  
  function change_password($user_id, $password) {
      $user_id = (int)$user_id;
	  $password = md5($password);
	  mysql_query("UPDATE `users` SET `password`= '$password' , `password_recover`= 0 WHERE `user_id`= $user_id ");  
   }
  
  function register_user($register_data) {

		array_walk($register_data, 'array_sanitize');                 // for sanitizing the whole array
		$register_data['password'] = md5($register_data['password']);        // for password safety--md5 encryption

		$fields = '`' . implode('`, `', array_keys($register_data)). '`'; // echo $fields = `username`, `password`, `first_name`, `last_name`, `email`
		$data = '\'' . implode('\', \'', $register_data). '\'';         // Values in fields
		
		mysql_query("INSERT INTO `users` ($fields) VALUES ($data)");
		// Sending Activation email to activate account after registration -- Check video no. 26
		email($register_data['email'], 'Activate your account', "Hello " . $register_data['first_name']. ",\n\n  You need to activate your account, so use the link below: \n\n http://localhost/mysite/Reg&Login/activate.php?email=" . $register_data['email'] . "&email_code=" . $register_data['email_code'] . "\n\n - phpacademy");  
		
   } // function register_user ends here...

  
  function user_count() {

    return mysql_result(mysql_query("SELECT COUNT('user_id') FROM users WHERE active = 1"),0);
  }

  function user_data($user_id){
       $data = array();
       $user_id = (int)$user_id;

       $func_num_args = func_num_args();
       $func_get_args = func_get_args();
                                           //print_r($func_get_args);
       if($func_num_args > 1){
           unset($func_get_args[0]);          // To test what this will do....use this statement after this statement: print_r($func_get_args);
           $fields = ' '.implode(', ', $func_get_args).' ';
           //echo $fields;           //To use in Mysql statement        //It will print: user_id, username, password, first_name, last_name, email
           $data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM users WHERE user_id = $user_id"));
           // $data variable now acts as an array.
           // print_r($data);
           
           return $data;
        }// if loop ends here


   } // function user_data ends here

   function logged_in(){                                    // This fucntion is for if the user is logged in or not....
      return (isset($_SESSION['user_id']))? true : false ;

   } // funtion logged_in ends here

    function user_exists($username) {
        $username = sanitize($username);

        $query = mysql_query("SELECT COUNT('user_id') FROM users WHERE username = '$username'");

        return (mysql_result($query, 0) == 1)? true : false ;

    } // function user_exists ends here
    
    function email_exists($email) {
        $email = sanitize($email);

        $query = mysql_query("SELECT COUNT('user_id') FROM users WHERE email = '$email'");

        return (mysql_result($query, 0) == 1)? true : false ;

    } // function email_exists ends here


    function user_active($username) {
        $username = sanitize($username);

        $query = mysql_query("SELECT COUNT('user_id') FROM users WHERE username = '$username' AND active = 1");

        return (mysql_result($query, 0) == 1)? true : false ;

    } // function user_active ends here

    function user_id_from_username($username){
      $username = sanitize($username);

      return mysql_result( mysql_query("SELECT user_id FROM users WHERE username = '$username'" ) ,0, 'user_id');

    }// function user_id_from_username ends here
    
    function user_id_from_email($email){
      $email = sanitize($email);

      return mysql_result( mysql_query("SELECT user_id FROM users WHERE email = '$email'" ) ,0, 'user_id');

    }// function user_id_from_email ends here

    function login($username, $password) {
      $user_id = user_id_from_username($username);
      $username = sanitize($username);
      $password = md5($password);
      
	  return (mysql_result( mysql_query("SELECT COUNT('user_id') FROM users WHERE username = '$username' AND password = '$password'" ),0) ==1)? $user_id : false;

    } // function login ends here


?>