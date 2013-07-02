<div class="grid_12">
    <div class="box">
        <h2>
            <?=__('News');?>
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
                            if(count($news)>0){
                                foreach ($news AS $row){
                                    ?>
                        <tr>
                            <td><?=$row['News']['title'];?></td>
                            <td><?=$row['News']['created'];?></td>
                            <td>
				<?php echo $this->Form->postLink('Edit', 
                    array('action' => 'edit', $row['News']['id']),
                    array('class'=>'button blue'));?>
				<?php echo $this->Form->postLink('Delete', 
                    array('action' => 'delete', $row['News']['id']),
                    array('class'=>'button red', 'confirm' => 'Are you sure?'));?>
			    </td>
                        </tr>
                                    <?php
                                }
                            } else {
                                ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No News Articles</td>
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