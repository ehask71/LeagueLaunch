<?php
$this->Html->script('datatables/media/js/jquery.dataTables.min', array('block' => 'scriptTop'));
?>
<div class="grid_6">
    <div class="box">
        <h2>
	    <?= __('Season'); ?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
		<table>
		    <tbody>
			<tr>
			    <td>Season:</td>
			    <td><?php echo $season['Season']['name'];?></td>
			</tr>
			<tr>
			    <td>Season Id:</td>
			    <td><?php echo $season['Season']['id'];?></td>
			</tr>
			<tr>
			    <td>Started:</td>
			    <td><?php echo $season['Season']['startdate'];?></td>
			</tr>
			<tr>
			    <td>Ending:</td>
			    <td><?php echo $season['Season']['enddate'];?></td>
			</tr>
			<tr>
			    <td>Registration Start</td>
			    <td><?php echo $season['Season']['registration_start'];?></td>
			</tr>
			<tr>
			    <td>Registration End</td>
			    <td><?php echo $season['Season']['registration_end'];?></td>
			</tr>
		    </tbody>
		</table>
	    </div>
	</div>
    </div>
</div>
<div class="grid_6">
    <div class="box">
        <h2>
	    <?= __('Details'); ?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
		
	    </div>
	</div>
    </div>
</div>
<div class="grid_12">
    <div class="box">
        <h2>
	    <?= __('Players'); ?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
		<table class="display" id="basictable">
		    <thead>
			<th>Player</th>
			<th>Birth Date</th>
			<th>League Age</th>
			<th>Division</th>
			<th>Paid</th>
			<th>Form Complete</th>
			<th>Verified Docs</th>
			<th>Options</th>
		    </thead>
		    <tbody>
			<?php
			if(count($players)> 0){
			    foreach($players AS $row):
				?>
			<tr>
			    <td><?php echo ucfirst(strtolower($row['Players']['firstname']));?> <?php echo ucfirst(strtolower($row['Players']['lastname']));?></td>
			    <td><?php echo $row['Players']['birthday'];?></td>
			    <td><?php echo $row['Players']['league_age'];?></td>
			    <td><?php echo $row['Divisions']['name'];?></td>
			    <td><?php echo ($row['PlayersToSeasons']['haspaid'] == 1)?'Yes':'No';?></td>
			    <td><?php echo ($row['PlayersToSeasons']['formcomplete'] == 1)?'Yes':'No';?></td>
			    <td><?php echo ($row['PlayersToSeasons']['verifydocs'] == 1)?'Yes':'No';?></td>
			    <td>
				
			    </td>
			</tr>
				<?php
			    endforeach;
			} else {
			    ?>
			<tr>
			    <td colspan="5">No Players To Display</td>
			</tr>
			    <?php
			}
			?>
		    </tbody>
		</table>
	    </div>
	</div>
    </div>
</div>