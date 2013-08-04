<div class="grid_12">
    <div class="box">
        <h2>
            <?=__('View Account');?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
		<table>
		    <tbody>
		    <tr>
			<td>Name</td>
			<td><?php echo $user['Account']['firstname'].' '.$user['Account']['firstname'];?></td>
		    </tr>
		    <tr>
			<td>Email</td>
			<td>
			    <?php echo $user['Account']['email'];?>
			</td>
		    </tr>
		    <tr>
			<td>Phone</td>
			<td>
			    <?php //echo $user['Account']['phone'];?>
			</td>
		    </tr>
		    <tr>
			<td>Active</td>
			<td>
			    <?php echo $user['Account']['is_active'];?>
			</td>
		    </tr>
		    </tbody>
		</table>
		<table>
		    <thead>
			<th>Roles</th>
		    </thead>
		    <tbody>
			<?php foreach($user['Role'] AS $role):?>
			<tr>
			    <td><?php echo ucfirst($role['alias']);?></td>
			</tr>
			<?php endforeach;?>
		    </tbody>
		</table>
		<h3>Players</h3>
		<table>
		    <thead>
		    <th>Name</th>
		    <th>Birthday</th>
		    <th>Gender</th>
		    <th>League Age</th>
		    <th>Options</th>
		    </thead>
		    <tbody>
			<?php foreach ($user['Players'] AS $player):?>
			<tr>
			    <td><?php echo $player['firstname'].' '.$player['lastname'];?></td>
			    <td><?php echo $player['birthday'];?></td>
			    <td><?php echo $player['gender'];?></td>
			    <td><?php echo $player['league_age'];?></td>
			    <td><?php echo $this->Form->postLink('View', 
                    array('action' => 'view_player', $player['player_id']),
                    array('class'=>'button blue'));?></td>
			</tr>
			<?php endforeach;?>
		    </tbody>
		</table>
		<pre>
		    <?php //print_r($user);?>
		</pre>
	    </div>
	</div>
    </div>
</div>