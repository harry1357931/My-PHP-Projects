
<?php
    
	 include 'init.php';
	 include 'func2.php';
 	 //update_New('update/', '', '');                            //$dir    = 'new/';  initially
	  
	   // rename('rename/2013_ford.jpg', 'rename/2013_ford_1.jpg') ;
	   // renew('update/Ford/New/trucks/F-150/others/');
	 $dir2    = 'honda/new/';
     $files = scandir($dir2);
     print_r($files);
	   
	   
     for($i=2; $i<=20; $i++){ 
	   
     // To open a directory and read file names....in this case photo names....
     if ($handle = opendir('Honda/New/'.$files[$i].'/')) {
         echo "Directory handle: $handle\n";
         echo "Entries:\n";
      
	     $images = array();  
	     $j = 0;
        
		// This is the correct way to loop over the directory. 
        while (false !== ($entry = readdir($handle))) {
		   
		  if($entry == '.' || $entry == '..'){
		      continue;
		  } 
	       
		   //$pieces = explode("_", $entry);
	       //mkdir('thumbs/'.$files[$i], 0744);  
		   //create_thumb('Honda/New/'.$files[$i].'/', $entry, 'thumbs/'.$files[$i].'/');
	       $images[$j] = $entry;
           echo "<br>".'<a href="honda/new/'.$files[$i].'/'.$images[$j-0].'"><img src="thumbs/'.$files[$i].'/'.$entry.'"  title="Cars"  alt="" /> '.$entry.'  </a>'."<br>";                      
           $j= $j+1;
		   
	   }
	  closedir($handle);
    }
  
 } 
 
?>

<?php
/* //This is the WRONG way to loop over the directory. 
      while ($entry = readdir($handle)) {
        echo "$entry\n";
      }
	  
	  <?php
     // To open a directory and read file names....in this case photo names....
    if ($handle = opendir('Edge/')) {
    echo "Directory handle: $handle\n";
    echo "Entries:\n";

    // This is the correct way to loop over the directory. 
    while (false !== ($entry = readdir($handle))) {
        echo "$entry\n"."<br>";
    }
	
	   echo '<a href="uploads/'. $image['album'] . '/' . $image['id'] . '.' . $image['ext'] . '"><img src="uploads/thumbs/'. $image['album'] . '/' . $image['id'] . '.' . $image['ext'] . '"  title="Uploaded ' . date('D M Y / h:1', $image['timestamp']). '"  alt="" /></a> [<a href="delete_image.php?image_id='. $image['id'] . '">x</a>]   ';
          
		//echo '<a href="edge/'.$images[$i-0].'"><img src="thumbs/'.$entry.'"  title="Cars"  alt="" /> '.$entry.' </a>'."<br>";                      
    
    closedir($handle);
}
?>
	  
	 // you can also use "scandir" function...it will return an array of files
	 ///////////////////
	 
	 // To open a directory and read file names....in this case photo names....
    if ($handle = opendir('Edge/')) {
    //echo "Directory handle: $handle\n";
    //echo "Entries:\n";
      
	$images = array();  
	$i = 0;
    // This is the correct way to loop over the directory. 
    while (false !== ($entry = readdir($handle))) {
	    
		$pieces = explode("_", $entry);
		//create_thumb('edge/', $entry, 'thumbs/');
		
	    $images[$i] = $entry;
        echo '<a href="edge/'.$images[$i-0].'"><img src="thumbs/'.$entry.'"  title="Cars"  alt="" /> '.$entry.'  </a>'."<br>";                      
        //."<br>"            ... '.$entry.'
        $i= $i+1; 
	}

    closedir($handle);
}

 */
?> 
