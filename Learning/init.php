<?php   
       // This file gives us access to our database and all our functions
   
     error_reporting(E_ALL);
     ini_set('display_errors', '1');
   
     ob_start();
     session_start();
     mysql_connect('localhost', 'root', 'Harry@1357931');
     mysql_select_db('website');
   
     include 'func/user.func.php';
     include 'func/album.func.php';
     include 'func/image.func.php';
     include 'func/thumb.func.php';
	 include 'function1.php';
	 
?>