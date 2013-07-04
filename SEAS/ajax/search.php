 
 <?php 


     require_once '../db.inc.php';      // ../ for traversing back the directory or folder.
    // include 'db.inc.php';
     if((isset($_POST['search_term'])==true) && (empty($_POST['search_term'])==false) ) {

        $search_term = mysql_real_escape_string($_POST['search_term']);  // To remove unwanted characters...and to prevent sql injection
        // $query will have the results after query from database
        $query = mysql_query("SELECT 'keywords' FROM 'searchengine' WHERE 'keywords' LIKE '$search_term'");
        
		
		while($row = mysql_fetch_assoc($query)){

           echo '<li>', $row['keywords'], '</li>';

        }// While loop ends here


       }// if loop  ends here




 
 
 
?>