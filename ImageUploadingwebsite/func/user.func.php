<?php
   
     function logged_in() {             // Check whether the user is logged_in or not
	      return isset($_SESSION['user_id']);
	  }
	 
	 function login_check($email, $password) {
	       
		   $email   = mysql_real_escape_string($email);
		   $login_query = mysql_query("SELECT COUNT(`user_id`) as `count` , `user_id` FROM `users` WHERE `email`= '$email' AND `password` = '".md5($password)."'");
	       return (mysql_result($login_query, 0) == 1) ? mysql_result($login_query, 0, 'user_id') : false ;   
	   }
	  
	  function user_data() {      // here only arguments were which were required...arguments are used only where they are reqd...not here...
	      
		  $args   = func_get_args();
		  $fields = '`' . implode('`, `', $args) . '`'; 
	      
		  $query = mysql_query("SELECT $fields FROM `users` WHERE `user_id` =" . $_SESSION['user_id']);
		  $query_result = mysql_fetch_assoc($query);
		  foreach($args as $field) {
		       $args[$field] = $query_result[$field]; 
		   }
		   
		  return $args;
	      
	   }
	   
	   function user_register($email, $name, $password){
	      
	      $email = mysql_real_escape_string($email);
		  $name = mysql_real_escape_string($name);
		  $password = md5($password);
		  
		  mysql_query("INSERT INTO `users` VALUES (NULL, '$email', '$name', '$password')");       // Put NULL instead of '' ....in this case
		  return mysql_insert_id();
		  
	   }
	   
	   function user_exists($email) {
	     
		  $email = mysql_real_escape_string($email);
		  $query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email' ");
		  return (mysql_result($query, 0) == 1)? true : false;  
	   }
   



?>