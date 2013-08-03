<?php echo Configure::read('Settings.leaguename'); ?> Online Registration

Thank You <?php echo $shop['Order']['first_name']; ?> <?php echo $shop['Order']['last_name']; ?> for your online registration

The League may require documentation to prove you player(s) age and physical address. If you selected "Pay At Field" you will need to
render payment before your player(s) will become eligible to play in the league.

Date: <?php echo date('m-d-Y')."\r\n"; ?>
Order Id: <?php echo $shop['Order']['order_id']."\r\n"; ?>
Total: $<?php echo $shop['Order']['total']."\r\n";?>
Registration Id: <?php echo Configure::read('Registration.id')."\r\n"; ?>


<?php
if (count($shop['OrderItem']) > 0) {
    $i=1;
    echo 'Item#      Item'."\r\n";
    foreach ($shop['OrderItem'] AS $item) {
        echo $i.'  '.$item['name'] . '      Qty:'. $item['quantity'] . ' @  $'. $item['price']."\r\n";
        $players = $this->Session->read('Player');
        if (count($players) > 0) {
            foreach ($players AS $play) {
                if ($item['product_id'] == $play['product']) {
                    echo '   ---> Player: ' . $play['player'] . "\r\n";
                }
            }
        }
        $i++;
    }
    echo 'Total: $'.$shop['Order']['total']."\r\n";
}
?>
