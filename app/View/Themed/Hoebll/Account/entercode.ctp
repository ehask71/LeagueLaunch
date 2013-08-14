<div class="grid_12" id="body-content"> 
    <div>
	<h2>Enter Reset Code</h2>
	<p>If your here I guess you lost your password. You should have received an email with a code or a link in it. You need to copy and paste the code below or just click the link in the email. 
	    If your not getting the email you need to check your spam for an email titled "<?php echo Configure::read('Settings.leaguename');?> Password Reset" and make sure to 
	    white list or mark as not spam.  If by any chance the email still is not there try again <?php echo $this->Html->link('Lost Password',array('action'=>'forgetpwd'));?></p>
	<br/><br/>
	<?php
	echo $this->Form->create('Account');
	echo $this->Form->input('code');
	echo $this->Form->end('Reset Password');
	?>
    </div>
</div>
<div class="grid_4" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>