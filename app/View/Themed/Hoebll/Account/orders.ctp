<div class="grid_12" id="body-content"> 
    <div>
        <h2><?= __('Previous Orders'); ?></h2>
	<table width="100%">
	    <thead>
		<tr>
		    <th>Order Id</th>
		    <th>Date</th>
		    <th>Status</th>
		    <th>Options</th>
		</tr>
	    </thead>
	    <tbody>
		<?php if (count($orders) > 0): ?>
		    <?php foreach ($orders AS $order): ?>
		<tr>
		    <td><?php echo $order['Order']['id'];?></td>
		    <td><?php echo $order['Order']['created'];?></td>
		    <td><?php echo ($order['Order']['status']==2)?'Paid':'Pending';?></td>
		    <td>
			<?php echo $this->Form->postLink('View', 
                    array('action' => 'vieworder', $order['Order']['id']),
                    array('class'=>'button green small'));?>
		    </td>
		</tr>
		    <?php endforeach; ?>
		<?php else: ?>
    		<tr>
    		    <td colspan="4">No Orders To Display</td>
    		</tr>
		<?php endif; ?>
	    </tbody>
	</table>
    </div>
</div>
<div class="grid_4" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>  