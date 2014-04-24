<div class="grid_12">
    <div class="box">
        <h2>
            Raffle Entries
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
		<table>
                    <thead>
                        <tr>
                            <th>Name</th>
			    <th>Order Id</th>
			    <th>Date</th>
			</tr>
		    </thead>
		    <tbody>
			<?php if(count($raffle) > 0){?>
			    <?php foreach($raffle AS $r){
				echo '<tr>';
				echo '<td>'.$r['Raffleticket']['firstname'].' '.$r['Raffleticket']['lastname'].'</td>';
				echo '<td>'.$r['Raffleticket']['order_id'].'</td>';
				echo '<td>'.$r['Raffleticket']['created'].'</td>';
			    } ?>
			<?php } else { ?>
			<tr>
			    <td colspan="100">No Entries!</td>
			</tr>
			<?php } ?>
		    </tbody>
		</table>
		<pre>
		    <?php print_r($raffle);?>
		</pre>
	    </div>
	</div>
    </div>
</div>