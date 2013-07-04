
 <?php
    include 'core/init.php';
	logged_in_redirect();                      // Protecting Pages...redirect based on login or not...
    include 'includes/overall/overallheader.php';

    if(empty($_POST) === false){                    // if registration form is submitted or posted, then it goes in...

       $required_fields = array('username','password','password_again','first_name','email');
       foreach($_POST as $key=>$value){
          if(empty($value) && in_array($key, $required_fields) === true){
               $errors[] = 'Fields marked with asterisk are required';
               break 1;
           }   // end of if(empty($value).... loop
        }  // end of foreach loop

       if(empty($errors) === true){  

           if(user_exists($_POST['username']) === true) {               // === checks type as Well
              $errors[] = 'Sorry, the username \''.$_POST['username']. '\' already exists.';
           }
           if(preg_match("/\\s/", $_POST['username']) == true) {         //Check for spaces in username, == (double equal) 1 == true....gud
              $errors[] = 'Your username must not contain any spaces';          //  1 === true ....not gud.....as preg match return intetger
           }
           if( strlen($_POST['password']) < 6 ){

              $errors[] = 'Your password must be atleast 6 characters long';
           }
           if( $_POST['password'] !== $_POST['password_again'] ){ 

              $errors[] = 'Your passwords do not match';
           }
           if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){                // To Valdate email address.
              $errors[] = 'A valid email address is required';
           }
           if(email_exists($_POST['email']) === true ){
              $errors[] = 'Sorry, the email \''.$_POST['email']. '\' is already in use.';
           }

        } // end of if(empty($errors).....loop

   } // end of if(empty($_POST)... loop

  ?>
 <h1>Register</h1>
  
 <?php

   if(isset($_GET['success']) === true && empty($_GET['success']) === true){

       echo 'You \'ve been registered successfully! Please check your email to activate your account';
   }
   else{                                                                                // no. 95
       if(empty($_POST) === false && empty($errors) === true){
           // This will register user after all the validation process.
            $register_data = array(
               'username'   =>  $_POST['username'],
               'password'   =>  $_POST['password'],
               'first_name' =>  $_POST['first_name'],
               'last_name'  =>  $_POST['last_name'],
               'email'      =>  $_POST['email'],
			   'email_code' =>  md5($_POST['username'] + microtime())         // We just want to keep email_code to be unique
			);

           register_user($register_data);        // $register_user is an array containing all data of user...
           // redirect
           header('Location: register.php?success');
           // Exit
           exit();
       }
       else if(empty($errors) === false) {
          echo output_errors($errors);                         // output_errors is a self defined funtion...in general.php file
       }// else if ends here...

      ?>

	 <p>Registration page.</p>
	 <form action = "" method = "POST">
		 <ul>
		   <li>
				Username*: <br>
				<input type = "text" name = "username" >
		   </li>
		   <li>
				Password*: <br>
				<input type = "password" name = "password" >
		   </li>
		   <li>
				Password again*: <br>
				<input type = "password" name = "password_again" >
			</li>
		   <li>
				First Name*:  <br>
				<input type = "text" name = "first_name">
		   </li>
		   <li>
				Last Name: <br>
				<input type = "text" name = "last_name">
		   </li>
		   <li>
				Email*: <br>
				<input type = "text" name = "email">
		   </li>
		   <li>
				<input type = "submit" value = "Register" >
		   </li>

		 </ul>

	 </form>
	 
	 <?php
  } // else no. 95 ends here
   include 'includes/overall/overallfooter.php';  ?>