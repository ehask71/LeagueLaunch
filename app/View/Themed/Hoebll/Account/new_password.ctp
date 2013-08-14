<div class="grid_12" id="body-content"> 
    <div>
	<h2>Enter New Password</h2>
	<p>Ok you made it!! Let's enter a new password and confirm so you can get back in.</p>
	<br/><br/>
	<?php
	echo $this->Form->create('Account');
	echo $this->Form->input('password');
	echo $this->Form->input('confirm_password',array('label' => 'Confirm Password'));
	echo $this->Form->input('rstcode',array('type'=>'hidden','value'=>$code));
	echo $this->Form->end('Reset Password');
	?>
    </div>
</div>
<div class="grid_4" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>