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
			<th></th>
		    </thead>
		</table>
		<pre>
		<?php print_r($season);?>
		<?php print_r($players);?>
		</pre>
	    </div>
	</div>
    </div>
</div>