<?php
    // function :- upload_image(... , ... , ...)
	// $image_ext :- extension of image .jpg, .gif ...etc ....we only allowed few extensions to be uploaded.
	// $image_temp :- Directory location...where to save the uploaded image.
	// $album_id :- Tells in which album to store the image.
	
    function upload_image($image_temp, $image_ext, $album_id) {        
	    
		$album_id = (int)$album_id;
		
		mysql_query("INSERT INTO `images` VALUES(NULL, '".$_SESSION['user_id']."', '$album_id', UNIX_TIMESTAMP(), '$image_ext')");
	    
		$image_id = mysql_insert_id();
		$image_file = $image_id . '.' . $image_ext;     // name of image in which it is going to be stored...
		
		move_uploaded_file($image_temp, 'uploads/'. $album_id .'/'. $image_file);
		
		create_thumb('uploads/'. $album_id .'/', $image_file, 'uploads/thumbs/'. $album_id .'/');
	
	}
	
	// Get all images from particular album having id: $album_id 
	
	function get_images($album_id)  { 
	   
	   $album_id = (int)$album_id;
	   $images = array();       // May be this gonna become multidimensional array....we gonna return this too...
	   
	   $image_query = mysql_query("SELECT `image_id`, `album_id`, `timestamp`, `ext` FROM `images` WHERE `album_id` = $album_id AND `user_id` =" . $_SESSION['user_id']); 
	   
	   while($images_row = mysql_fetch_assoc($image_query)) {
	   
	       $images[] = array(
		     
			  'id'         =>  $images_row['image_id'], 
		      'album'      =>  $images_row['album_id'],
			  'timestamp'  =>  $images_row['timestamp'],
			  'ext'        =>  $images_row['ext']
		   
		   );
		   
	    } // while loop ends here
	   
	   return $images; 
	   
	}
	
	// Check to what user that image belong too...not sure  
	
	function image_check($image_id) { 
	   
	  $image_id = (int)$image_id;
	  $query = mysql_query("SELECT COUNT(`image_id`) FROM `images` WHERE `image_id` = $image_id AND `user_id` =" . $_SESSION['user_id']);
	  
	  return (mysql_result($query, 0) == 1)? true : false ;
	
	
	}
	
	function delete_image($image_id) {
	
	   $image_id = (int)$image_id;
	   
	   // Getting album_id of image to be deleted...as we will use it for deleting image from directory having name album_id...
	   $image_query = mysql_query("SELECT `album_id`, `ext` FROM `images` WHERE `image_id` = $image_id AND `user_id`=" . $_SESSION['user_id']);
	   $image_result = mysql_fetch_assoc($image_query);
	   
	   $album_id = $image_result['album_id'];
	   $image_ext = $image_result['ext'];
	   
	   unlink('uploads/'. $album_id . '/' . $image_id . '.' . $image_ext);
	   unlink('uploads/thumbs/'. $album_id . '/' . $image_id . '.' . $image_ext);
	   // delete image
	   mysql_query("DELETE FROM `images` WHERE `image_id` = $image_id AND `user_id`=" . $_SESSION['user_id']);
       
	
    }


?>