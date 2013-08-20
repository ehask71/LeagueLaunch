<div class="grid_12" id="body-content"> 
    <div>
	<h2>Forgotten Password?</h2>
	<p>No Problem! Please enter your email below and click "Help Me". We will send a link that will allow you to reset your password.</p>
	<br/><br/>
	<?php
	echo $this->Form->create('Account');
	echo $this->Form->input('email');
	echo $this->Form->end('Help Me');
	?>
    </div>
</div>
<div class="grid_4" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>