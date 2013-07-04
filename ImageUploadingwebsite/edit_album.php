<?php

   include 'init.php';
    
   if(!logged_in()){              // We don't want unlogged user to create albums...
  
     header('Location: index.php');
	 exit();
   }
   
   // check if get var set
   // check if album belongs to user...look if loop below
   
   if(!isset($_GET['album_id']) || empty($_GET['album_id']) ||  album_check($_GET['album_id']) === false) {    // empty($_GET['album_id']) for cases like...?album_id=   ...that is empty but set...or we can say equal to nothing. 
   
      header('Location: albums.php');
	  exit();
   }
   
   include 'template/header.php';
   ?>
   
   <h3>Edit Album</h3>
   <?php  
      $album_id = $_GET['album_id'];
      $album_data = album_data($album_id, 'name', 'description');  
	  
	  if(isset($_POST['album_name'], $_POST['album_description'])) {
	  
	      $album_name         =  $_POST['album_name'];
	      $album_description  =  $_POST['album_description'];
		  
		  $errors = array();
		  
		  if(empty($album_name) || empty($album_description)) {
		  
		      $errors[] = 'Album name and description required';
		  }
		  else {
		       if(strlen($album_name) > 55 || strlen($album_description) > 255){
				   $errors[] = 'One or more fields contains too many characters'; 
			   }
		   }
		   
		  if(!empty($errors)){
			   
			   foreach($errors as $error){
			       echo $error, '</br>';   
			   }
		  }
		  else{
	            
				// Edit album
                edit_album($album_id, $album_name, $album_description);	
                header('Location: albums.php');
                exit();				
		   }
	  
	   }
   
   ?>
   
   
  <form action="?album_id=<?php echo $album_id; ?>" method="post">
      
	  <p>
	      Name: </br>
		  <input type="text" name="album_name" maxlength="55" value="<?php echo $album_data['name']; ?>" />
	  </p>
	  <p>
	      Description: </br>
		  <textarea name = "album_description" rows="6" cols="35" maxlength="255"> <?php echo $album_data['description']; ?> </textarea>
	  </p>
	  <p>
	      <input type="submit" value="Edit">
	  </p>
  
  </form>   
   
   
   
  <?php
  
  include 'template/footer.php';
?>