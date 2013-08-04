<div class="grid_12">
    <div class="box">
        <h2>
            <?php echo __('Seasons');?>
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
                            <th>Registration Start</th>
                            <th>Registration End</th>
                            <th>Active</th>
                            <th>Updated</th>
			    <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(count($divisions)>0){
                                foreach ($divisions AS $row){
                                    ?>
                        <tr>
                            <td><?=$row['Season']['name'];?></td>
                            <td><?=$row['Season']['startdate'];?></td>
                            <td><?=$row['Season']['startdate'];?></td>
                            <td><?=$row['Season']['registration_start'];?></td>
                            <td><?=$row['Season']['registration_end'];?></td>
                            <td><?=$row['Season']['active'];?></td>
                            <td><?=$row['Season']['updated'];?></td>
                            <td>
				<?php echo $this->Form->postLink('Edit', 
                    array('action' => 'edit', $row['Season']['id']),
                    array('class'=>'button blue'));?>
				<?php echo $this->Form->postLink('Delete', 
                    array('action' => 'delete', $row['Season']['id']),
                    array('class'=>'button red', 'confirm' => 'Are you sure?'));?>
			    </td>
                        </tr>
                                    <?php
                                }
                            } else {
                                ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No Seasons Configured</td>
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