<div class="grid_12" id="body-content"> 
<h2>Login</h2>
<?php
echo $this->Form->create();
echo $this->Form->input('email');
echo $this->Form->input('password');
echo $this->Form->end('Login');
?>
</div>
<div class="grid_4" id="side-bar-right">
    <?php echo $this->element('schedule_widget',array(),array('cache'=>array('time'=>'+1 hour')));?>
    <?php echo $this->element('events_widget',array(),array('cache'=>array('time'=>'+1 hour')));?>
    <?php echo $this->element('sponsors_widget',array(),array('cache'=>array('time'=>'+1 hour')));?>
</div>
