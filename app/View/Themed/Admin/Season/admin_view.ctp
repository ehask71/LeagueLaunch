<?php
echo $this->Html->css('/theme/admin/js/datatables/media/css/demo_table_jui');
$this->Html->script('datatables/media/js/jquery.dataTables.min', array('block' => 'scriptTop'));
$this->Html->scriptStart(array('block' => 'scriptBottom'));
echo '
	jQuery(document).ready(function() {
		oTable = $("#basictable").dataTable({
				"bJQueryUI": true,
				"sPaginationType": "full_numbers"
			});
	} );';
$this->Html->scriptEnd();
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
				<?php 
                                    echo '<form action="/admin/season/view/'.$season['Season']['id'].'" name="post_haspaid" id="post_haspaid" method="POST">';
                                    echo '<input type="hidden" name="data[Season][id]" value="' . $season['Season']['id'] . '"/>';
                                    echo '<input type="hidden" name="data[PlayerToSeasons][id]" value="' . $row['PlayersToSeasons']['id'] . '"/>';
                                    echo '<input type="hidden" name="data[PlayerToSeasons][field]" value="haspaid"/>';
                                    echo '<input type="hidden" name="data[PlayerToSeasons][action]" value="toggle"/>';
                                    echo '</form>';
                                    echo '<a href="#" class="button green small" onclick="document.getElementById(\'post_haspaid\').submit(); event.returnValue = false; return false;">' . __('Paid') . '</a>';
                                ?>
                                <?php 
                                    echo '<form action="/admin/season/view/'.$season['Season']['id'].'" name="post_formcomplete" id="post_formcomplete" method="POST">';
                                    echo '<input type="hidden" name="data[Season][id]" value="' . $season['Season']['id'] . '"/>';
                                    echo '<input type="hidden" name="data[PlayerToSeasons][id]" value="' . $row['PlayersToSeasons']['id'] . '"/>';
                                    echo '<input type="hidden" name="data[PlayerToSeasons][field]" value="formcomplete"/>';
                                    echo '<input type="hidden" name="data[PlayerToSeasons][action]" value="toggle"/>';
                                    echo '</form>';
                                    echo '<a href="#" class="button blue small" onclick="document.getElementById(\'post_formcomplete\').submit(); event.returnValue = false; return false;">' . __('Forms') . '</a>';
                                ?>
                                <?php 
                                    echo '<form action="/admin/season/view/'.$season['Season']['id'].'" name="post_verifydocs" id="post_verifydocs" method="POST">';
                                    echo '<input type="hidden" name="data[Season][id]" value="' . $season['Season']['id'] . '"/>';
                                    echo '<input type="hidden" name="data[PlayerToSeasons][id]" value="' . $row['PlayersToSeasons']['id'] . '"/>';
                                    echo '<input type="hidden" name="data[PlayerToSeasons][field]" value="verifydocs"/>';
                                    echo '<input type="hidden" name="data[PlayerToSeasons][action]" value="toggle"/>';
                                    echo '</form>';
                                    echo '<a href="#" class="button red small" onclick="document.getElementById(\'post_verifydocs\').submit(); event.returnValue = false; return false;">' . __('Verify') . '</a>';
                                ?>
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