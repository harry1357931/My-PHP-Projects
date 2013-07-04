<?php 

    include 'functions/func.inc.php';
    include 'connect/db.inc.php';  
	  
?>

<!DOCTYPE html>
<html>
   <head>
		<script src="javascript/index1.js"></script>
		<script src="javascript/jquery.js"></script>
        <script src="javascript/primary.js"></script>
		
		<link  rel="stylesheet"  href="css/primary.css" >
		<link  rel="stylesheet"  href="css/screen.css" >
   </head>
   <body>
        <div id="container_1">                                                    <!--      1    -->
		   <div id="container_1_a">
               
			   <form action="" method="post">		      
				  
				  <input type="text" name="keywords" class="autosuggest" title="Smartest Car Search Engine...< 30 MIN. challenge" >
				  <button type="submit" id="search_button1" title="dude calm down and sit...hv fun"  onmouseover="Chg_button_view(this)" onmouseout="Normal_button_view(this)" >Auto Chillax Search</button>
				  <button type="submit" id="search_button2" onmouseover="Chg_button_view(this)" onmouseout="Normal_button_view(this)" > Manual Search</button>
			   
			   </form>
		   
		   </div>   
		</div>	
        
        <div id="container_2">                                                     <!--      2    -->
		   
		   Menu -- Easy go
		   
		   In container 3 </br>
		   Search Results </br>
		   + = more info...little down...</br>
		   Bigger image + info ==> some scroll dynamic link </br>
		   User Info => some </br>
           Photo album:- link...</br>
		  
		   
		</div>	
		
		
        
        <div id="container_3">                                                    <!--      3     -->
		   
		    
		<?php

			   if(isset($_POST['keywords']))  {
				  $keywords=  htmlentities(trim($_POST['keywords']));

			   }
			   $errors= array();
			   if(empty($keywords)) {
				 $errors[]= 'Please enter a search term';
			   }
			   else if(strlen($keywords)<3) {
				$errors[]= 'Your search terms must be 3 or more characters'; }
			   else if(search_results($keywords)===false){              //(search_results()==false){             // search_results() function defined in another file
				$errors[]= 'Your search for '.$keywords.' returned no results';
			   }

			   if(empty($errors)) {

					//echo '<pre>', print_r(search_results($keywords)), '</pre>';         // search_results function will return results in multi-dimensional array
					$results= search_results($keywords);
					$results_num= count($results);
				   echo "<p>Your search for <strong>  $keywords </strong> yield <strong> $results_num </strong> results. </p>";
					// $results is now a Two-dimensional array containing results
					foreach($results as $result) {

					   echo '<p><strong>', $result['title'], '</strong> <br>', $result['description'], '<br><a href= "',$result['url'],'" target= "_blank">',$result['url'],'</a></p>';
                    
					} // foreach loop ends here

			   }
			   else {
				  foreach($errors as $error) {
				   echo $error, '</br>';
				  }
				}

		   ?> 
		   
		   
		</div>	
		
		
		<div class="dropdown">                                                     <!--      2    -->
		  <ul class="result">
		     

		  </ul>
		</div>	
		
		

        <div id="container_4">                                                     <!--      4     -->
		   
		   Details on Click...</br>
		   or...Details on scroll
		   
		</div>	

        
   </body>
</html>


<!-- 
  
  <li> 
			    <div style="position:relative;  top:0px; width:120px;"> 
 			      <img src="thumbs/civic_coupe/honda_civic_coupe_main.jpg" align="left">
			    </div>   
			  
			    <div style="position:relative; left:30px; width:356px; height:100px;">
			      harry
			    </div>
		     
			 </li>
			 
			 <li> 
			    <div style="position:relative;  top:0px; width:120px;">   
 			      <img src="thumbs/civic_coupe/honda_civic_coupe_main.jpg" align="left">
			    </div>   
			  
			    <div style="position:relative; left:30px; width:356px; height:100px;">
			      harry
			    </div>
		     
			 </li>

-->