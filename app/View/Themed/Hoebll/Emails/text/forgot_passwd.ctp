<?php echo Configure::read('Settings.leaguename'); ?> 


Hello <?php echo $account['Account']['firstname']; ?>,

Here is the link to reset your password 
       
  <?php echo 'http://'.$_SERVER['SERVER_NAME'].'/account/resetcode/'.$code; ?>

If the link does not work please go here <?php echo 'http://'.$_SERVER['SERVER_NAME'].'/account/entercode/';?> 
and enter this code in the box. Code: <?php echo $code;?>

   

