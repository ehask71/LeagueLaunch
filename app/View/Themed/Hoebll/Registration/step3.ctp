<?php
$this->Html->scriptStart(array('block' => 'scriptBottom'));
echo "$(document).ready(function(){

	$('#OrderSameaddress').click(function(){

		if($('#OrderSameaddress').attr('checked', 'checked')) {

			$('#OrderShippingAddress').val($('#OrderBillingAddress').val());
			$('#OrderShippingAddress2').val($('#OrderBillingAddress2').val());
			$('#OrderShippingCity').val($('#OrderBillingCity').val());
			$('#OrderShippingState').val($('#OrderBillingState').val());
			$('#OrderShippingZip').val($('#OrderBillingZip').val());
			$('#OrderShippingCountry').val($('#OrderBillingCountry').val());

		} else {

			$('#OrderShippingAddress').val('');
			$('#OrderShippingAddress2').val('');
			$('#OrderShippingCity').val('');
			$('#OrderShippingState').val('');
			$('#OrderShippingZip').val('');
			$('#OrderShippingCountry').val('');

		}

	});

});";
$this->Html->scriptEnd();
?>
<div class="grid_12" id="body-content">
    <h2>Address</h2>
    <?php echo $this->Form->create('Order'); ?>

            <?php echo $this->Form->input('first_name'); ?>
            <br />
            <?php echo $this->Form->input('last_name'); ?>
            <br />
            <?php echo $this->Form->input('email'); ?>
            <br />
            <?php echo $this->Form->input('phone'); ?>

            <?php echo $this->Form->input('billing_address'); ?>
            <br />
            <?php echo $this->Form->input('billing_address2'); ?>
            <br />
            <?php echo $this->Form->input('billing_city'); ?>
            <br />
            <?php echo $this->Form->input('billing_state'); ?>
            <br />
            <?php echo $this->Form->input('billing_zip'); ?>
            <br />
            <?php echo $this->Form->input('billing_country'); ?>
            <br />
            <br />

            <?php echo $this->Form->input('sameaddress', array('type' => 'checkbox', 'label' => 'Copy Billing Address to Shipping')); ?>

            <?php echo $this->Form->input('shipping_address'); ?>
            <br />
            <?php echo $this->Form->input('shipping_address2'); ?>
            <br />
            <?php echo $this->Form->input('shipping_city'); ?>
            <br />
            <?php echo $this->Form->input('shipping_state'); ?>
            <br />
            <?php echo $this->Form->input('shipping_zip'); ?>
            <br />
            <?php echo $this->Form->input('shipping_country'); ?>
            <br />
            <br />
        </div>
            <?php echo $this->Form->input('order_type', array('label'=>'Payment Method','class' => 'chzn-select','type'=>'select','options'=>$payment_types)); ?>
    </div>

    <br />

    <?php echo $this->Form->button('Continue', array('class' => 'btn btn-default btn-primary')); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="grid_5" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>
