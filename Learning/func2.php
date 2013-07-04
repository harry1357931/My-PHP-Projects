
<?php
	 
	 //rename('rename/2013_ford.jpg', 'rename/2013_ford_1.jpg') ;
	 
	 function renew($dir){                         // still to enter variable in main file
	      
		 $files = scandir($dir);
		 
		 for($i=2; $i< count($files); $i++){
			   
			   $file = $files[$i];
	
   	           if(is_dir($dir.$file)){
			       renew($dir.$file.'/');
			   }
			   else{
			      
				  $ext = explode('.', $file);
				  $ext = $ext[1];
				  //echo $ext."<br>";
				  if($ext=='jpg' || $ext=='PNG'){
				     echo $ext."<br>";
					 $broke = explode('_', $file);
					 //rename($dir.$file, $dir.'2013_'.$broke[0].'_'.$broke[1].' '.$broke[2].'_'.$broke[3].'_X_X_all_'.$broke[4]);
					 rename($dir.$file, $dir.'2012_'.$broke[1].'_'.$broke[2].'_'.$broke[3].'_'.$broke[4].'_'.$broke[5].'-EdmundsDotCom_'.$broke[6].'_'.$broke[7]);
				  }
			         
			   }
			   		   
		  } // for loop ends here	  
		   
      }// function ends here
	  
	  
	  
?>