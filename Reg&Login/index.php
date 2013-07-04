 <?php
     include 'core/init.php';
     include 'includes/overall/overallheader.php';
      // error_reporting(0);       //To turn off the error reporting, 0 to turn off reporting
 ?>
 <h1>Home</h1>
 <p>Just a Template.</p>
 
 <?php
      
	  if(has_access($session_user_id, 1) === true){
	      echo 'Admin!';                                    // Admin = 1 (type)
	  }
	  else if(has_access($session_user_id, 2) === true){
	      echo 'Moderator!';                                // Moderator = 2 (type)
	  }
  ?>
  

 <?php  include 'includes/overall/overallfooter.php';  ?>