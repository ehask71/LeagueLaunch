<div class="grid_12">
    <div class="box">
        <h2>
            <?=__('View Account');?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
		<h3>User</h3>
		<table>
		    <tbody>
		    <tr>
			<td>Name</td>
			<td><?php echo $user['Account']['firstname'].' '.$user['Account']['lastname'];?></td>
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
		    <th>Roles <span style="float: right;"><a href="/admin/account/addrole/<?=$user['Account']['id'];?>" class="button green">Add Role</a></span></th>
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
                        <tr>
                            <td style="text-align: right;" colspan="5">
                                <?php echo $this->Html->link('Add Player', 
                    '/admin/account/addplayer/'.$user['Account']['id'],
                    array('class'=>'button green'));?>
                            </td>
                        </tr>
                        <tr>
		    <th>Name</th>
		    <th>Birthday</th>
		    <th>Gender</th>
		    <th>League Age</th>
		    <th>Options</th>
                        </tr>
		    </thead>
		    <tbody>
			<?php foreach ($user['Players'] AS $player):?>
			<tr>
			    <td><?php echo $player['firstname'].' '.$player['lastname'];?></td>
			    <td><?php echo $player['birthday'];?></td>
			    <td><?php echo $player['gender'];?></td>
			    <td><?php echo $player['league_age'];?></td>
			    <td><?php echo $this->Form->postLink('Edit', 
                    array('action' => 'editplayer', $player['player_id']),
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