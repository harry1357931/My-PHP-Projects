<?php
   include 'connect/db.inc.php';
   include 'func/functions.php';
   include 'template/header.php';
   echo '<h2 class="heading">Page Name: Main</h2>';
 ?>  
 
  <?php
			
		if(isset($_POST['topic'], $_POST['page_name']) === true){
		   
		   $topic = $_POST['topic'];
		   $page_name = $_POST['page_name'];
		   $errors = array();
		   
		   if(empty($topic)|| empty($page_name)){
			  $errors[] = 'All fields required*';
		   }
		   
		   if(!empty($errors)){
			 foreach($errors as $error){
				echo $error . '</br>';  
			 }					
		   }
		   else{
			  addTopic($topic, $page_name);
			  //header('Location: index.php');        // Relocating user after successfully adding Topic
			  //exit();
		   }
		   
		}// main if loop
		else {
		  echo 'Form is Not Posted Yet!'.'<br>';
		}
		    	 
   ?>   
	      	   
		<div id="container_main">   
		    <?php   
			    DisplayTopicNamesForMain("main");   
			?>
		</div> 
		
		<div id="container_forms">
			<form action="" method="post">
			   <p>
				  Enter New Topic or Sub Topic*: </br>
				  <input type="text" name="topic" maxlength="55" />
			   </p>
			   
			   <p>
				  Page Name(Parent Main Page)*: </br>
				  <input type="text" name="page_name" maxlength="55" />
			   </p>
			  
			   <p>
				  <input type="submit" value="Add New Topic"/>
			   </p>
			
			</form>
		</div> 
   
    <?php
        include 'template/footer.php';
    ?>

  