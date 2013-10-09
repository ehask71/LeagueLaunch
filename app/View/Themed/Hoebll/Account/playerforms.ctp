<div class="grid_12" id="body-content"> 
    <div>
        <h2><?= __($title_for_layout); ?></h2>
	<pre>
	<?php print_r($forms);?>
	</pre>
    </div>
</div>
<div class="grid_4" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div> 