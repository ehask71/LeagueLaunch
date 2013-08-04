<div class="grid_12" id="body-content">
<h2>Register</h2> 
<?php
$this->Html->scriptStart(array('block' => 'scriptBottom'));
    echo "$(function() {
	$('#birthDate').datepicker({ dateFormat: 'yy-mm-dd',changeMonth: true, changeYear: true });
    });";
$this->Html->scriptEnd();
    
echo $this->Form->create();
echo $this->Form->input('site_id',array('type'=>'hidden','value'=>$site_id));
echo $this->Form->input('firstname');
echo $this->Form->input('lastname');
echo $this->Form->input('zip');
echo $this->Form->input('country',array('type'=>'select','options'=>$countries,'style'=>'chzn-select'));
echo $this->Form->input('birthdate',array('id'=>'birthDate'));
echo $this->Form->input('gender',array('type'=>'radio','options'=>array('m','f')));
echo $this->Form->input('email');
echo $this->Form->input('password');
echo $this->Form->input('confirm_password');
echo $this->Form->input('agever',array('type'=>'checkbox','value'=>1,'label' =>'Are you over the age of 13'));
echo $this->Form->input('agreeterms',array('type'=>'checkbox','value'=>1,'label' => 'I agree to the <a href="/terms" target="_blank">Terms & Conditions</a>'));
echo $this->Form->end('Register');
?>
</div>
<div class="grid_4" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>