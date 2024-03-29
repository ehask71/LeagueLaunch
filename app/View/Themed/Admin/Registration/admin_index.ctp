<div class="grid_12">
    <div class="box">
        <h2>
	    <?= __('Registration Events'); ?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
			    <th>Start Date</th>
			    <th>End Date</th>
                            <th>Created</th>
			    <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
			<?php
			if (count($registrations) > 0):
			    foreach ($registrations AS $row) {
				?>
				<tr>
				    <td><?php echo $row['Registration']['name']; ?></td>
				    <td><?php echo $row['Registration']['startdate']; ?></td>
				    <td><?php echo $row['Registration']['enddate']; ?></td>
				    <td><?php echo $row['Registration']['created']; ?></td>
				    <td>
					<a href="/admin/forms/edit/<?=$row['Registration']['id'];?>" class="button blue">Edit</a> 
					<?php echo $this->Form->postLink('Delete', 
					    array('action' => 'delete', $row['Registration']['id']),
					    array('class'=>'button red', 'confirm' => 'Are you sure?'));?>
				    </td>
				</tr>
				<?php
			    }
			else :
			    ?>
    			<tr><td colspan="5" align="center">No Registration Events</td></tr>
			<?php
			endif;
			?>
		    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>