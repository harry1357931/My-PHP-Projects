<?php

   include 'init.php';
   include 'template/header.php';
   
   if(logged_in()){
      
	  echo 'Welcome, you can now start to <a href="create_album.php">Create Albums</a> and <a href="upload_image.php">Upload Images</a>';
   
   }
   else{
      echo '<img src="images/landing.png" alt="Register a free account today" />';
   }
   
   include 'template/footer.php';
?>