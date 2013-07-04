 <?php
     include 'core/init.php';
	 protect_page();
	 
	 if(empty($_POST)=== false){
	    $required_fields = array('current_password','password','password_again');
		foreach($_POST as $key=>$value){
          if(empty($value) && in_array($key, $required_fields) === true){
               $errors[] = 'Fields marked with asterisk are required';
               break 1;

            }   // end of if(empty($value).... loop
        }  // end of foreach loop
	 
	    if(md5($_POST['current_password']) === $user_data['password'] ){    // $user_data array including password variable initialized in init.php file
		    if(trim($_POST['password']) !== trim($_POST['password_again'])){   // trim remove -- white space from the LHS and RHS
			    $errors[] = 'Your new passwords do not match';
		    }
			else if(strlen($_POST['password']) < 6){
			    $errors[] = 'Your new password must be atleast 6 characters long';   
			}
		}
		else{
		   $errors[] = 'Your current password is incorrect';
		
		}
    
	 } // end of if loop 
	 
     include 'includes/overall/overallheader.php';
      // error_reporting(0);       //To turn off the error reporting, 0 to turn off reporting
 ?>
 <h1>Change Password</h1>
 
 <?php 
  
   if(isset($_GET['success']) === true && empty($_GET['success']) === true){
        echo 'You \'ve changed your password successfully!';
   }
   else{
   
      if(isset($_GET['force']) === true && empty($_GET['force']) === true){
       ?> 
		   <p>You must change your password now that you've requested.</p>
		<?php
       }
 
      if(empty($_POST) === false && empty($errors) === true){
          change_password($session_user_id, $_POST['password']);
          header('Location: changepassword.php?success');
	  }else if(empty($errors) === false){                                        // there are errors and to print errors		  
	      echo output_errors($errors); 
	    }
	 ?>
	 
	 <form action="" method="post">
		 <ul>
			<li>
				Current Password*: <br>
				<input type="password" name="current_password"> <br>
			</li>
			<li>
				New Password*: <br>
				<input type="password" name="password"> <br>
			</li>
			<li>
				New Password again*: <br>
				<input type="password" name="password_again"> <br>
			</li>
			<li>
				<input type="submit" value="Change password">
			</li>			
		 </ul>    
	 </form>
	 

	 <?php 
   } // else ends here 
   include 'includes/overall/overallfooter.php';  
   
  ?>