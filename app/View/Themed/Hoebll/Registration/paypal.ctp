<div class="grid_12" id="body-content">
    <p>Please Click the button below to be redirected to PayPal to complete Payment</p>
    <br/><br/>
    <div class="payment_button">
    <?php echo $this->paypal->button('Pay Now', array('amount' => $shop['Order']['total'], 
        'item_name' => Configure::read('Settings.leaguename').' Online Registration '.Configure::read('Registration.id'),
        'business' => Configure::read('Settings.paypal_email'),
        'notify_url' => 'http://'.$_SERVER['SERVER_NAME'].'/paypal_ipn/process/',
        'invoice' => $shop['Order']['order_id'],'image_button'=>'paypal.jpg'));?>
    </div>
</div>
<div class="grid_4" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>