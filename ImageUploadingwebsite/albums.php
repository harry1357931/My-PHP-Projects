<?php

   include 'init.php';
   
   if(!logged_in()){
       header('Location: index.php');
	   exit();
    }
	
   include 'template/header.php';
   
   ?>
   
   <h3>Albums</h3>
   
   
   
   
   
   <?php
   
   $albums = get_albums();
   
   if(empty($albums)) {
      echo '<p>You don\'t have any albums</p>';
   }
   else {
       // there are some albums...now display them...
	   
	   foreach($albums as $album) {          // remember $albums is a multi dimension array....and here $album acts as a sub array containing details of single album
	      
		  echo '<p><a href="view_album.php?album_id=', $album['id'], '">', $album['name'], '</a> (', $album['count'], ' images) </br>
		  ', $album['description'], '...</br>
		  <a href="edit_album.php?album_id=', $album['id'], '">Edit</a> / <a href="delete_album.php?album_id=', $album['id'], '">Delete</a>
		  </p>';
	   
	   
	   }
   
   }
   
   include 'template/footer.php';
?>