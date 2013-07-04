 <?php
       // Admin depends on the "type" field in database...value of type defines whether the user is admin or not, type= 0 => not admin 
	 include 'core/init.php';
	 protect_page();
	 admin_protect();
     include 'includes/overall/overallheader.php';
      
 ?>
 <h1>Email all Users -- You Admin</h1>
 
 <?php
      
	  if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	     ?>
		     <p>Email has been sent to all users</p>
		 <?php
	   }
	  else{
	  
			if(empty($_POST) === false){
				   
			  if(empty($_POST['subject']) === true ){
				  $errors[] = 'Subject is required!';
			   }
			   
			  if(empty($_POST['body']) === true ){
				  $errors[] = 'Body is required!';
			   }
			  
			  if(empty($errors) === false){
				  echo output_errors($errors);
			  }
			  else {
				 // Send Email to Users
				 mail_users($_POST['subject'], $_POST['body']);
				 header('Location: mail.php?success');
				 exit();
			   }		   
			
			}
		  ?>
		 
		  <form action = "" method = "post">
			 <ul>
				  <li>
					 Subject*: <br>
					 <input type="text" name="subject">
				  </li>
				  <li>
					 Body*:<br>
					 <textarea name="body"></textarea>
				  </li>
				  <li>
					 <input type="submit" value="Send Email">
				  </li>		  
			 </ul>
		 
		  </form>
		 
		 <?php  
 
       } // else ends here  
 
     include 'includes/overall/overallfooter.php'; 
  ?>