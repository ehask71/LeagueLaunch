<div class="grid_12">
    <div class="box">
        <h2>
            <?=__('Forms');?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Created</th>
			    <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(count($forms)>0){
                                foreach ($forms AS $row){
                                    ?>
                        <tr>
                            <td><?=urldecode($row['Forms']['name']);?></td>
                            <td><? //$row['Forms']['created'];?></td>
                            <td>
				<a href="/admin/forms/edit/<?=$row['Forms']['id'];?>" class="button blue">Edit</a> 
				<?php echo $this->Form->postLink('Delete', 
                    array('action' => 'delete', $row['Forms']['id']),
                    array('class'=>'button red', 'confirm' => 'Are you sure?'));?>
			    </td>
                        </tr>
                                    <?php
                                }
                            } else {
                                ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No Forms To Display</td>
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