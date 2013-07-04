<?php     // This file is for containing general functions
    
	function email($to, $subject, $body) {
	
	   mail($to, $subject, $body, 'From: hello@phpacademy.org');  
	}
	
	
	function logged_in_redirect() {                  // USE - when logged in -- redirect to index.php rather than register.php  
	    
	    if(logged_in() === true ) {
		    header('Location: index.php');
			exit();
		}
    }
	
	function protect_page(){                               // To protect pages like downloads and forum.
	
	   if(logged_in() === false) {
	       header('Location: protected.php'); 
           exit();		   
	   }
	}
	
	function admin_protect() {
	    global $user_data;
		
		if(has_access($user_data['user_id'], 1) === false){            
		   header('Location: index.php');
		   exit();
		}
		
	}
	
	
	function array_sanitize(&$item)  {              // & symbol for variables that gonna be return back...like changing at the address

       $item = htmlentities(strip_tags(mysql_real_escape_string($item)));     // strip_tags  :- Strips away HTML and PHP tags from like first_name...etc

    }            // array_sanitize function will automatically loop through and sanitize each element-- Inbuilt function

    function sanitize($data) {

      return htmlentities(strip_tags(mysql_real_escape_string($data)));
    }

    function output_errors($errors) {
       $output = array();
       foreach($errors as $error){
          $output[] = '<li>' .$error. '</li>';
       } // forloop ends here

      return '<ul>' .implode('',$output). '</ul>';
       //return '<ul><li>' .implode('</li><li>',$errors). '</li></ul>';   // Other Way: Just replace all stuff in this function with this statement

    } // function output_errors ends here

?>