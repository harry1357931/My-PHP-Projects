 <?php  
         // in this file...we will not use header and footer file...as we don't want to make seperate delete page....we will just
		 // delete the album and refer again to albums.php....with the album being deleted not there....

   include 'init.php';
    
   if(!logged_in()){              // We don't want unlogged user to create albums...
  
     header('Location: index.php');
	 exit();
   }
   
   // check if get var set
   // check if image belongs to user...look if loop below
   
   if(!isset($_GET['image_id']) || empty($_GET['image_id']) ||  image_check($_GET['image_id']) === false) {    // empty($_GET['album_id']) for cases like...?album_id=   ...that is empty but set...or we can say equal to nothing. 
   
      header('Location: albums.php');
	  exit();
   }
   
   if(isset($_GET['image_id'])){
      
	  $image_id = $_GET['image_id'];
      delete_image($image_id);	        // delete album function
      header('Location: '. $_SERVER['HTTP_REFERER']);
      exit();	
   
   }
   
   
  
   ?>
    