<?php
$this->Html->scriptStart(array('block' => 'scriptBottom'));
echo "$(function() {
	$('#confirmation').submit();
    });";
$this->Html->scriptEnd();
?>
<div class="grid_12" id="body-content">
        <form name="confirmation" id="confirmation" method="post" action="https://www.paypal.com/cgi-bin/webscr">
            <input type="hidden" name="business" value="<?php echo Configure::read('Settings.paypal_email'); ?>">
            <input type="hidden" name="cmd" value="_xclick">
            <input type="hidden" name="rm" value="2">
            <input type="hidden" name="amount" value="<?php echo $shop['Order']['total'] ?>">
            <input type="hidden" name="return" value="<?php echo $_SERVER["SERVER_NAME"]; ?>/registration/success">
            <input type="hidden" name="cancel_return" value="<?php echo $_SERVER["SERVER_NAME"]; ?>/registration/oops">
            <input type="hidden" name="item_name" value="<?php echo Configure::read('Settings.leaguename'); ?> Online Registration">
            <input type="hidden" name="currency_code" value="USD">
            <input type="hidden" name="no_note" value="0">
            <input type="hidden" name="first_name" value="<?php echo $shop['Order']['first_name']; ?>">
            <input type="hidden" name="last_name" value="<?php echo $shop['Order']['last_name']; ?>">
            <input type="hidden" name="email" value="<?php echo $shop['Order']['email']; ?>">
            <input type="hidden" name="country" value="US">
        </form>
</div>
<div class="grid_5" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>