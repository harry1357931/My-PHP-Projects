 <?php
     include 'core/init.php';
     include 'includes/overall/overallheader.php';
 
      if(isset($_GET['username']) === true && empty($_GET['username']) === false){
	     
		$username  =  $_GET['username'];
		
		if(user_exists($username) === true) {
		    $user_id        = user_id_from_username($username);
		    $profile_data   = user_data($user_id, 'first_name', 'last_name', 'email');
	     ?>
            <h1><?php echo $profile_data['first_name']; ?>'s Profile</h1> <br>
			<h3> First Name: <?php echo $profile_data['first_name']; ?> </h3><br>
			<h3> Last Name :  <?php echo $profile_data['last_name']; ?> </h3><br>
			<h3> Email     : <?php echo $profile_data['email']; ?> </h3>
         <?php		 
			
		}
		else{
		    echo 'Sorry!, that user does not exist...';
		}
	    
	  }
	  else {
	       header('Location: index.php');
           exit();    
	  }
   


     
	 include 'includes/overall/overallfooter.php';  
  ?>