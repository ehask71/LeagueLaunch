<div class="grid_12" id="body-content">
    <h2><?php echo __('Step 2: Additional Options')?></h2>
    <?php 
	echo '<div>Subtotal: $'.$shop['Order']['subtotal'].'</div>';
	echo $this->Form->create(FALSE, array('type' => 'file', 'action' => 'step2'));
	foreach ($upsells as $key => $value) {
	    echo $this->Form->input('Upsell.'.$key, array('label'=>$value['name'].' - $'.$value['price'],'type'=>'select','options'=>array('no'=>'No','yes'=>'Yes')));
	    echo '<div class="form-text">'.__($value['description']).'</div>';
	}
	echo $this->Form->end('Proceed to Review');
    ?>
</div>
<div class="grid_4" id="side-bar-right">
<?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>