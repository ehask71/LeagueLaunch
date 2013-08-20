<div class="grid_12" id="body-content"> 
    <div>
        <h2><?= __('Add Player'); ?></h2>
	<?php echo $this->Form->create('Players');?>
	<?php echo $this->Form->input('firstname');?>
	<?php echo $this->Form->input('lastname');?>
	<?php echo $this->Form->input('nickname');?>
	<?php echo $this->Form->input('gender',array('type'=>'select','class'=>'chzn-select','options'=>array('m'=>'Male','f'=>'Female')));?>
	<?php echo $this->Form->input('birthday');?>
	<?php echo $this->Form->end('Add Player');?>
    </div>
</div>
<div class="grid_4" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div> 