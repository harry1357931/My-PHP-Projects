 <?php                                       // This file is basically for updating the user's first name, last name and email.
     include 'core/init.php';
	 protect_page();
	 include 'includes/overall/overallheader.php';
	 
	 if(empty($_POST) === false){                    // if registration form is submitted or posted, then it goes in...

        $required_fields = array('first_name','email');
        foreach($_POST as $key=>$value){
          if(empty($value) && in_array($key, $required_fields) === true){
               $errors[] = 'Fields marked with asterisk are required';
               break 1;

            }   // end of if(empty($value).... loop
        }  // end of foreach loop
		
		if(empty($errors) === true){
           if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){                // To Valdate email address, or if its format is correct or not
              $errors[] = 'A valid email address is required';
           }
           else if(email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']){
              $errors[] = 'Sorry, the email \''.$_POST['email']. '\' is already in use.';
           }
        
		} // end of if(empty($errors).....loop
		
		
     }
  
  ?>      
   <h1> Settings </h1>
  <?php
      
	  if(isset($_GET['success']) === true && empty($_GET['success']) === true){

           echo 'Your details \'ve been updated successfully!';
      }
	  else
	  {
      
			if(empty($_POST) === false && empty($errors) === true){
			   
			   $allow_email = ($_POST['allow_email'] == 'on')? 1 : 0;    // for check box stuff :-- allow email...
			   // update user details -- using array
			   $update_data = array(
				  'first_name'   =>  $_POST['first_name'],
				  'last_name'    =>  $_POST['last_name'],
				  'email'        =>  $_POST['email'],
				  'allow_email'  =>  $allow_email
			    );
			   update_user($session_user_id, $update_data);       // update user function
			   header('Location: settings.php?success');
			   exit();
			  
			}
			else if(empty($errors) === false){
			   echo output_errors($errors);
			}
		  
			?>
		   
		   <form action = "" method = "POST">
			 <ul>
				   <li>
						First Name*:  <br>
						<input type = "text" name = "first_name" value="<?php echo $user_data['first_name'] ?>">
				   </li>
				   <li>
						Last Name: <br>
						<input type = "text" name = "last_name" value="<?php echo $user_data['last_name'] ?>">
				   </li>
				   <li>
						Email*: <br>
						<input type = "text" name = "email" value="<?php echo $user_data['email'] ?>">
				   </li>
				   <li>
						<input type = "checkbox" name = "allow_email"  <?php if($user_data['allow_email'] == 1) { echo 'checked = "checked"';}  ?>  > Would you like to receive email from us?
				   </li>
				   <li>
						<input type = "submit" value = "Update">
				   </li>

			 </ul>

		   </form>
		  
		  
		   <?php
       } // else ends here  
	 include 'includes/overall/overallfooter.php';  
   
  ?>