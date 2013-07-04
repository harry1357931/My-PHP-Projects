<?php

 session_start();
 session_destroy();
 
 // redirecting to index.php file after destruction of session.

 header('Location: index.php');


?>