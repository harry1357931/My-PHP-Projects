
<?php
    
	 include 'init.php';
	
	 $dir    = 'new/';
     $files = scandir($dir);
     print_r($files);
	   
	   
 for($i=2; $i<=20; $i++){ 
	   
    // To open a directory and read file names....in this case photo names....
    if ($handle = opendir('Honda/New/'.$files[$i].'/')) {
         //echo "Directory handle: $handle\n";
         //echo "Entries:\n";
      
	     $images = array();  
	     $j = 0;
        
		// This is the correct way to loop over the directory. 
        while (false !== ($entry = readdir($handle))) {
		
	       echo $entry."<br>";
		   
		   //$pieces = explode("_", $entry);
		   //mkdir('thumbs/'.$files[$i], 0744);  
		   //create_thumb('Honda/New/'.$files[$i].'/', $entry, 'thumbs/'.$files[$i].'/');
	       $images[$j] = $entry;
           echo '<a href="honda/new/'.$files[$i].'/'.$images[$j-0].'"><img src="thumbs/'.$files[$i].'/'.$entry.'"  title="Cars"  alt="" /> '.$entry.'  </a>'."<br>";                      
           $j= $j+1; 
	   }
	    

      closedir($handle);
    }
  
 } 
?>