<?php                         // This page gonna return array of result
  include 'db.inc.php';

  function search_results($keywords) {
      $returned_results= array();
      $where= "" ;           // Used in query
      $total= 0;

      $keywords= preg_split('/[\s]+/', $keywords);        // To break keywords elements into array...one word one element, seperated by space
      // $keywords= explode(' ', $keywords);   // Not good for multiple Spaces in Words...
       // print_r($keywords);
      $total_keywords= count($keywords);   // count function to count no. of keywords or no. of elements in the array

       foreach($keywords as $key=>$keyword){

        $where .= "keywords LIKE '%$keyword%'";               // Appending using .= , and making string for query %xyz% search from both sides
        if($key != ($total_keywords-1)){
             $where .= " AND " ;
          }// if loop ends
        } // for loop ends

       $results= "SELECT title, Left(description, 70) as description, url FROM searchengine WHERE $where";  // this is just the string, we make it ready for

       // mysql query function, Left('description', 70) -- To take out first 70 characters from start of 'description' onwards
       // as 'description' : this part is important as it will return the results...
       // mysql_query() function is used for query from the data base...and it returns the Stuff too

       $results_num = ($results = mysql_query($results)) ? mysql_num_rows($results) : 0 ;
       //  echo $results_num;
       if($results_num===false){
         return false;
       }else {
       
           while($results_row = mysql_fetch_assoc($results)) {
             
             $returned_results[] = array(
                
                    'title' => $results_row['title'],
                    'description' => $results_row['description'],
                    'url' => $results_row['url']

               );

           }// while loop ends here

       }    //else ends here
       
       return $returned_results;


   }   // function Search Results


 ?>