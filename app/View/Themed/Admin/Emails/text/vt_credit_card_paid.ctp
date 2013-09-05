

Hello <?php echo $order['first_name'] .' '. $order['last_name'];?>,

You successfully paid via Credit Card in the amount of $<?php echo $order['total'];?>
    
Date Paid:  <?php echo date('m-d-Y')."\r\n";?>
Order#:  <?php echo $order['id'];?>
Credit Card Transaction#: <?php echo $authnet['transaction'];?>


Thank You,
<?php echo Configure::read('Settings.leaguename');?>