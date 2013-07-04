 <?php
     include 'core/init.php';
	 logged_in_redirect();        // if user is already logged in, then user don't need to activate....if logged in--it will redirect somewhere else.
     include 'includes/overall/overallheader.php';
     
     if(isset($_GET['success']) === true && empty($_GET['success']) === true){         // after activation of account... 
	   ?>
           <h2>Thanks, we 've activated your account....</h2>
		   <p>You're free to log in!</p>
	   
       <?php	 
	 }
	 else if(isset($_GET['email'], $_GET['email_code']) === true){
	    $email       =   trim($_GET['email']);
		$email_code  =   trim($_GET['email_code']);  
	    
		if(email_exists($email) === false){
		
		   $errors[] = 'OOPS...Something went wrong and We could n\'t find that email address';
		}
		else if( activate($email, $email_code) === false ) {         //activate function will return true after activating succesfully the account and return false if it could not activate that account
		   $errors[] = 'We had problems activating your account';
		}
		
		if(empty($errors) === false){
		 ?>
		     <h2>OOPS...</h2> 
		 <?php
		     echo output_errors($errors);
		}
		else{                                       // acc. to this code, this means if we have no errors...then we are successful in activation.
		  header('Location: activate.php?success');
		  exit();
		}
		
	 }
	 else{
	    header('Location: index.php');
		exit();
	 }

	 include 'includes/overall/overallfooter.php';  
	  
  ?>