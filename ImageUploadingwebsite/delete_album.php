 <?php  
         // in this file...we will not use header and footer file...as we don't want to make seperate delete page....we will just
		 // delete the album and refer again to albums.php....with the album being deleted not there....

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
   
   if(isset($_GET['album_id'])){
      
	  $album_id = $_GET['album_id'];
      delete_album($album_id);	        // delete album function
      header('Location: albums.php');
      exit();	
   
   }
   
   
  
   ?>
   