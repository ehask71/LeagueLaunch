<div class="grid_12" id="body-content">
    <h2><?php echo __('Step 3: Review and Pay');?></h2>
    <div>
	<?php
	    echo "<pre>";
	    print_r($data);
	    print_r($shop);
	?>
    </div>
</div>
<div class="grid_5" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>
