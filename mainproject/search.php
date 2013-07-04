
 <?php


    
    include 'connect/db.inc.php';

     if(isset($_POST['search_term'])==true && empty($_POST['search_term']) ==false ) {

        $search_term = mysql_real_escape_string($_POST['search_term']);  // To remove unwanted characters...and to prevent sql injection
        // $query will have the results after query from database

         //$query = mysql_query("SELECT keywords FROM searchengine WHERE keywords LIKE '$search_term%'");
         
		 $query = mysql_query("SELECT make, model, color, price, stock_photo, body_style, engine_type FROM cars WHERE model LIKE '$search_term%'");
         
		  while($row = mysql_fetch_assoc($query)){

             echo '<li>'.$row['model'].' '.$row['body_style'];
             echo '<br><hr><img  style="border:1px solid #DEE0E0;" src="thumbs/'.$row['model'].'_'.$row['body_style'].'/'.$row['stock_photo'].'" align="left">';
             echo '<div style="position:relative; left:30px; width:356px; height:100px;"> Harry </div> </li>';
			 
		  }// While loop ends here
		  

      }// if loop  ends here


  ?>
 
