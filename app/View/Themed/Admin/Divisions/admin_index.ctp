<div class="grid_12">
    <div class="box">
        <h2>
            Divisions
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
		<?php echo $this->Form->create('Divisions', array(
			    'class' => 'form_place',
			    'type' => 'file',
                            'inputDefaults' => array(
                                'div' => false,
                                'label' => false,
                                'before' => '<section class="form_row"><div class="grid_2">',
                                'between' => '</div><div class="grid_10"><div class="block_content">',
				'after' => '</div></div><div class="clear"></div></section>'
                            )
			));?>
		<?=$this->Form->input('site_id',array(
                                'type' => 'hidden',
				'value' => $site_id,
                                'before' => '',
                                'between' => '',
				'after' => ''
			    ));?>
		<?=$this->Form->input('name',array(
				'class' => 'i-format',
				'label' => 'New Division',
				//'after' => '<small>Domain</small></div></div><div class="clear"></div></section>'
			    ));?>
		<?php echo $this->Form->end('Add Division'); ?>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
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
                            <td><?=$row['Divisions']['name'];?></td>
                            <td><?=$row['Divisions']['last_updated'];?></td>
                            <td></td>
                        </tr>
                                    <?php
                                }
                            } else {
                                ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No Divisions Configured</td>
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