<div class="grid_12">
    <div class="box">
        <h2>
            <?=__('Accounts');?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Active</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(count($users)>0){
                                foreach ($users AS $row){
                                    ?>
                        <tr>
                            <td><?=$row['Account']['firstname'].' '.$row['Account']['lastname'];?></td>
                            <td><?=$row['Account']['is_active'];?></td>
                            <td><?php echo $this->Form->postLink('View', 
                    array('action' => 'view', $row['Account']['id']),
                    array('class'=>'button blue'));?></td>
                        </tr>
                                    <?php
                                }
                            } else {
                                ?>
                        <tr>
                            <td colspan="5">No Accounts</td>
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