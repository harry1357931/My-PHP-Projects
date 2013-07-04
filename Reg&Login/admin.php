 <?php
       // Admin depends on the "type" field in database...value of type defines whether the user is admin or not, type= 0 => not admin 
	 include 'core/init.php';
	 protect_page();
	 admin_protect();
     include 'includes/overall/overallheader.php';
      
 ?>
 <h1>Admin</h1>
 <p>Admin Page</p>

 <?php  include 'includes/overall/overallfooter.php';  ?>