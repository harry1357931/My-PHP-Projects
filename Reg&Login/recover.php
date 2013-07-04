 <?php
     include 'core/init.php';
	 logged_in_redirect();            // We know that the user is not logged in....that's why we use it...when he will be logged in...then we don't want him to see this page.
     include 'includes/overall/overallheader.php';
      
 ?>
 <h1>Recover</h1>
 <?php             //http://localhost/mysite/reg&login/recover.php?mode=username    ....for dealing with this kind of URL's
    
      if(isset($_GET['success'])=== true && empty($_GET['success'])=== true){
	     ?>
		      <p>Thanks! we've emailed you.</p>
    	 <?php 
      }
	  else{

		  $mode_allowed = array('username', 'password');
			
		  if(isset($_GET['mode'])=== true && in_array($_GET['mode'], $mode_allowed)=== true)  {
			
				if(isset($_POST['email'])=== true && empty($_POST['email'])=== false){   // if email is already set
				   
					if(email_exists($_POST['email'])=== true){        // recover(... , ...); generic function
					   recover($_GET['mode'], $_POST['email']);      // $_GET['mode'] will tell what to recover-- username or password....and $_POST['email'] will help us recover technically. 
					   header('Location: recover.php?success');
					   exit();
					}
					else{
					   echo '<p>Sorry! We couldn\'t find that email address.</p>';
					}
				
				}
				
				?>
				  <form action="" method="post"> 
					 <ul>
						 <li>
							Please enter your email: <br>
							<input type="text" name="email">
						 </li>
						 <li>
							<input type="submit" value="Recover">
						 </li>
					 </ul>
				  </form>
				<?php    
		   }
		   else{
			 header('Location: index.php');
			 exit();
		   }
 
 
        }
  ?>
  
 <?php  include 'includes/overall/overallfooter.php';  ?>