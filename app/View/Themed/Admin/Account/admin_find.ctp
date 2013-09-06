<div class="grid_12">
    <div class="box">
        <h2>
            <?=__('Accounts');?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <?php
                echo $this->Form->create('Article', array(
                    'url' => array_merge(array('action' => 'find'), $this->params['pass'])
                ));
                echo $this->Form->input('firstname', array('div' => false));
                echo $this->Form->input('lastname', array('div' => false));
                echo $this->Form->input('email', array('div' => false));
                echo $this->Form->submit(__('Search'), array('div' => false));
                echo $this->Form->end();
                ?>
                <table>
                    <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('firstname', 'First Name');?></th>
                            <th><?php echo $this->Paginator->sort('lastname', 'Last Name');?></th>
                            <th><?php echo $this->Paginator->sort('is_active', 'Active');?></th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(count($users)>0){
                                foreach ($users AS $row){
                                    ?>
                        <tr>
                            <td><?=$row['Account']['firstname'];?></td>
                            <td><?=$row['Account']['lastname'];?></td>
                            <td><?=$row['Account']['is_active'];?></td>
                            <td><?php echo $this->Html->link('View', 
                    '/admin/account/view/'.$row['Account']['id'],
                    array('class'=>'button blue'));?>
                            <?php echo $this->Html->link('Add Player', 
                    '/admin/account/addplayer/'.$row['Account']['id'],
                    array('class'=>'button green'));?>
                            </td>
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
                    <tfoot>
                    <th colspan="5"><?php echo $this->Paginator->numbers(array('first' => 2, 'last' => 2));?></th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>