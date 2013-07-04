<?php

   function addTopic($TopicName, $PageName){
      
	  $ToCheckRepeat = mysql_query("SELECT * FROM `topics` WHERE `page_name`='$PageName' AND `name`='$TopicName' ");
	  $ToCheckPageNameExistsOrNot = mysql_query("SELECT * FROM `topics` WHERE `name`='$PageName'");     // Here we are checking...whether Parent Page Exists or Not...in the name...
	  if (mysql_num_rows($ToCheckRepeat) != 0){
	      echo '"Topic Name" and "Main Page Name" Co-exists before...Use Different Parent Page Name!"';
	  }
	  else if(mysql_num_rows($ToCheckPageNameExistsOrNot) == 0){
	      echo 'Parent Page Name Don"t Exist...Check Page Name Spelling...or Add Page Name First...';
	  }
	  else{
          $addTopic = mysql_query("INSERT INTO `topics` VALUES (NULL, '$TopicName', '$PageName','','')");
	  }
	  
   }
   
   function DisplayTopicNamesForMain($page_name){        // Only for main functions
      
	  $TopicNames = mysql_query("SELECT * FROM `topics` WHERE `page_name`='$page_name'");
	  
	  if(mysql_num_rows($TopicNames) != 0){
	   
	     while( $TopicName = mysql_fetch_assoc($TopicNames)){
	       echo '<div class="container_sub"><a href="Stage2.php?name='.$TopicName['name'].'"><b>'.$TopicName['name'].'</b></a>
		          '.DisplaySubTopics($TopicName['name']).' 
			    </div>';
	    }
	  }
    }
	
	function DisplaySubTopics($page_name){        // Only for main functions  
      
	  $TopicNames = mysql_query("SELECT * FROM `topics` WHERE `page_name`='$page_name'");
	  $ToPaste="";       // Make a String...then Sending it back...
	  
	  if (mysql_num_rows($TopicNames) != 0){
	     while( $TopicName = mysql_fetch_assoc($TopicNames)){
	        $ToPaste = $ToPaste.'<br>&nbsp;&nbsp;&nbsp;<a href="Stage2.php?name='.$TopicName['name'].'">'.$TopicName['name'].'</a>';
	     }
	  }
	  
	  return $ToPaste;
    }
	
   
?>

<?php 
   
   /*
      function DisplayTopicNamesForOthers($page_name){        // for Stage 2
      
	  $TopicNames = mysql_query("SELECT * FROM `topics` WHERE `page_name`='$page_name'");
	  
	  if (mysql_num_rows($TopicNames) != 0){
	   
	     while( $TopicName = mysql_fetch_assoc($TopicNames)){
	       echo '<div class="container_sub"><a href="Stage2.php?name='.$TopicName['name'].'"><b>'.$TopicName['name'].'</b></a>
		       </div>';
	     }
	  }
    }
   
   */


?>

