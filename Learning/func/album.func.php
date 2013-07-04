<?php

   function album_data($album_id){      // returns album data after passing album id....
      
	  $album_id = (int)$album_id;      // casting album_id into integer type...
	  $args   = func_get_args();
	  unset($args[0]);             // $args[0]...is album id...and we don't want this in $fields...where we gonna implode $args...
	  $fields = '`' . implode('`, `', $args) . '`'; 
	  
	  $query = mysql_query("SELECT $fields FROM `albums` WHERE `album_id` = $album_id AND `user_id` =" . $_SESSION['user_id']);
	  $query_result = mysql_fetch_assoc($query);
	  foreach($args as $field) {
		   $args[$field] = $query_result[$field]; 
	   }
	   
	  return $args;
   
   }
  
  function album_check($album_id){
      
	  $album_id = (int)$album_id;
	  $query = mysql_query("SELECT COUNT(`album_id`) FROM `albums` WHERE `album_id` = $album_id AND `user_id` =" . $_SESSION['user_id']);
	  
	  return (mysql_result($query, 0) == 1)? true : false ;
   
  }
  
  function get_albums(){
  
      $albums = array();        // Multidimensional array ..... Multiple albums with properties of each album too...
	  $albums_query = mysql_query("
	      
		  SELECT `albums`.`album_id`, `albums`.`timestamp`, `albums`.`name`, LEFT(`albums`.`description`, 50) as `description`, COUNT(`images`.`image_id`) as `image_count` 
	      FROM `albums`
		  LEFT JOIN `images`
		  ON `albums`.`album_id` = `images`.`album_id`
          WHERE `albums`.`user_id` = ".$_SESSION['user_id']."
          GROUP BY `albums`.`album_id`		  
	      
		  ");    // as description....here description is like a variable name...
		  
	  while($albums_row = mysql_fetch_assoc($albums_query)) {     // This loop run 2 times if we have 2 albums...or 3 times if we have 3 albums...and so on..
	  
	      $albums[] = array(                     // Firstly, we declare $albums = array(); , and now here we declare $albums[] = array(...); ....which make $albums a Multi-dimension array.
		      'id'           =>  $albums_row['album_id'], 
		      'timestamp'    =>  $albums_row['timestamp'],
			  'name'         =>  $albums_row['name'],
			  'description'  =>  $albums_row['description'],
			  'count'        =>  $albums_row['image_count']
		   ); 
	   
	   }	  
      
	  return $albums;
      
   }
   
   function create_album($album_name, $album_description){
       $album_name         =  mysql_real_escape_string(htmlentities($album_name));
       $album_description  =  mysql_real_escape_string(htmlentities($album_description));
       
	   mysql_query("INSERT INTO `albums` VALUES (NULL, '".$_SESSION['user_id']."', UNIX_TIMESTAMP(), '$album_name', '$album_description')");    //UNIX_TIMESTAMP() :- an mysql function
       // mkdir(..., ...)  --- function for creating directories
 	   mkdir('uploads/'.mysql_insert_id(), 0744);             // 0744 --- means some permissions to directory...like read or something like this...
       mkdir('uploads/thumbs/'.mysql_insert_id(), 0744);       //mysql_insert_id() --- gives album_id of last insertion.
    
	}
   
   function edit_album($album_id, $album_name, $album_description){
       $album_id = (int)$album_id;
	   $album_name         =  mysql_real_escape_string(htmlentities($album_name));
       $album_description  =  mysql_real_escape_string(htmlentities($album_description));
       
       mysql_query("UPDATE `albums` SET `name` = '$album_name', `description` = '$album_description' WHERE `album_id` = $album_id AND `user_id` =" . $_SESSION['user_id']);	   
       	   
   }
   
   function delete_album($album_id) {
       $album_id = (int)$album_id;
	   
	   //Still to do: use a method to delete all files from album folder and thumbs folder, then the directory
	   
	   // To delete albums having album_id something
	   mysql_query("DELETE FROM `albums` WHERE `album_id` = $album_id AND `user_id`=" . $_SESSION['user_id']);
       
	   // To delete images having album_id something
	   mysql_query("DELETE FROM `images` WHERE `album_id` = $album_id AND `user_id`=" . $_SESSION['user_id']);
       
	   
	   
   }


?>