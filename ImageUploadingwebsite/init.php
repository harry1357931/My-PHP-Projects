<?php   
       // This file gives us access to our database and all our functions
   
   ob_start();
   session_start();
   mysql_connect('localhost', 'root', 'Harry@1357931');
   mysql_select_db('visualupload');
   
   
   include 'func/user.func.php';
   include 'func/album.func.php';
   include 'func/image.func.php';
   include 'func/thumb.func.php';
?>