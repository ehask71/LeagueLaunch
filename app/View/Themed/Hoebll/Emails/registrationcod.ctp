<?php echo Configure::read('Settings.leaguename'); ?> Online Registration

Date: <?php echo date('m-d-Y'); ?>
Order Id: <?php echo $shop['Order']['order_id']; ?>
Registration Id: <?php echo Configure::read('Registration.id'); ?>

Order:
<?php
if (count($shop['OrderItem']) > 0) {
    $i=1;
    foreach ($shop['OrderItem'] AS $item) {
        echo $i.' '.$item['name'] . '  Qty:'. $item['quantity'] . '  $'. $item['price'];
        $players = $this->Session->read('Player');
        if (count($players) > 0) {
            foreach ($players AS $play) {
                if ($item['product_id'] == $play['product']) {
                    echo '---> Player: ' . $play['player'] . ' ';
                }
            }
        }
    }
}
?>

Thank You <?php echo $shop['Order']['first_name']; ?> <?php echo $shop['Order']['last_name']; ?> for your online registration

The League may require documention to prove you player(s) age and physical address. If you selected "Pay At Field" you will need to
render payment before your player(s) will become eligable to play in the league. 



