
 <?php
 
  session_start();          // To start any session or wherever we are using $_SESSION variable...in any file

  $username = $_POST['username'];
  $password = $_POST['password'];

if($username && $password)
  { $connect = mysql_connect('localhost', 'root', 'Harry@1357931');
     mysql_select_db('phplogin');
    $query= mysql_query("SELECT *FROM users WHERE username= '$username'");
    $numrows= count($query);                     // mysql_num_rows($query);
  //  echo $numrows;
    if($numrows!=0)
    {
      while($row= mysql_fetch_assoc($query))
      {    $dbusername= $row['username'];
           $dbpassword= $row['password'];
      }
// Check to see if they match
       if($username==$dbusername&&$password==$dbpassword)
       {         echo "You are in...WELCOME...<a href='member.php'>Click </a> here to enter member page.";
                   $_SESSION['username'] = $username;
       }
       else
         echo "Incorrect Password !";
    }
    else
      die ("User doesn't exist");

}
  else
  {
   die("Please enter a username and password...");
  }


?>

