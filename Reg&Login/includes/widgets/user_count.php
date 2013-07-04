
  <div class="widget">                                           <!--  user_count widget-- user_count file in Widget -->
     <h2> Users </h2>
     <div class="inner">
         <?php  
            $user_count = user_count();
            $suffix = ($user_count != 1)? 's': '';
         ?>
         We currently have <?php echo user_count(); ?> registered user<?php echo $suffix; ?>.
     </div>
  </div>
