
   <div class="widget">                                           <!--  loggedin widget-- loggedin file in Widget -->
     <h2>Hello, <?php  echo $user_data['first_name'];   ?> </h2>
     <div class="inner">
         <ul>
            <li>
               <a href = 'logout.php'>Log out</a>
            </li>
            <li> 
               <a href = "profile.php?username=<?php echo $user_data['username'] ?>">Profile</a>      <!-- Modify it Later when you will use htaccess-->
            </li>
			<li> 
               <a href = 'changepassword.php'>Change Password</a>
            </li>
			<li> 
               <a href = 'settings.php'>Settings</a>               <!-- For Updating Profile Information -->
            </li>
         </ul>
     </div>
   </div>
