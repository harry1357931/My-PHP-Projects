
<?php
	 
	 function update_New($dir, $indent, $make){                            //$dir    = 'new/';  initially
	      
		 $files = scandir($dir);
		 
		 for($i=2; $i< count($files); $i++){
			   
			   $file = $files[$i];
	
               if($dir == 'update/'){                       // Creating Table Images_$make and Album_$make....at 1st level
			      $make = $files[$i];
				  // create_table_albums_and_images($make);
			    }
                else if($dir == 'update/'.$make.'/New/'){                    // To insert albums....
			      echo '11111111';
			   
			    }
				//echo $dir;

               echo $make;				
			   
   			   echo $indent.$file;
			   echo "<br>";
               if(is_dir($dir.$file)){
			      update_New($dir.$file.'/', $indent.'.......' , $make);
			   }
			   else{
			      // verify IMAGE...
				       // Insert Image...into album
			   
			   }
			   		   
		  } // for loop ends here	  
		   
      }// function ends here
	  
	  function create_table_albums_and_images($make){
	  	            	
		   mysql_query("CREATE TABLE `albums_$make` 
			 (
			   album_$make_id INT NOT NULL AUTO_INCREMENT,
			   PRIMARY KEY(album_$make_id),
			   timestamp INT,
			   name VARCHAR(32),
			   description VARCHAR(100),
			   path VARCHAR(200)
			  
		    )") or die(mysql_error());	

            mysql_query("CREATE TABLE `images_$make` 
			  (
			   images_$make_id INT NOT NULL AUTO_INCREMENT,
			   PRIMARY KEY(images_$make_id),
			   album_$make_id INT,
			   timestamp INT,
			   name VARCHAR(32),
			   description VARCHAR(100),
			   path VARCHAR(200)
			  
			)") OR die(mysql_error());			
	  
	   }   // function ends here...
	  
	  
?>