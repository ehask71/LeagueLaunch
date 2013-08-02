<div class="grid_12" id="body-content">
    <h2><?php echo __('Step 3: Review and Pay'); ?></h2>
    <div>
	Items:
	<table>
	    <thead>
		<tr>
		    <th>Product</th>
		    <th>Qty</th>
		    <th>Price</th>
		</tr>
	    </thead>
	    <?php
	    if (count($shop['OrderItem']) > 0) {
		foreach ($shop['OrderItem'] AS $item) {
		    echo '<tr>';
		    echo '<td>' . $item['name'] . '</td>';
		    echo '<td>' . $item['quantity'] . '</td>';
		    echo '<td>' . $item['price'] . '</td>';
		    echo '</tr>';
		    if(count($players)> 0){
			foreach ($players AS $play){
			    if($item['product_id'] == $play['product']){
				echo "<tr>";
				echo '<td colspan="3"> ---> Player: '.$play['player'].'</td>';
				echo '</tr>';
			    }
			}
		    }
		}
	    }
	    ?>
	    <tr>
		<td colspan="2" align="right">SubTotal:</td><td>$<?php echo $shop['Order']['subtotal'];?></td>
	    </tr>
	    <tr>
		<td colspan="2" align="right">Total:</td><td>$<?php echo $shop['Order']['total'];?></td>
	    </tr>
	</table>
	<?php
	/*echo "<pre>";
	print_r($players);
	print_r($data);
	print_r($shop);*/
	?>
    </div>
</div>
<div class="grid_5" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>
