<div class="grid_12">
    <div class="box">
        <h2>
            <?php echo __('Teams');?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
		<?php echo $this->Form->create('Team', array(
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
		<?=$this->Form->input('division_id',array(
				'type' => 'select',
                                'label' => 'Division',
				'options' => $divisions,
				'class' => 'i-format'
		));?>
		<?=$this->Form->input('name',array(
				'class' => 'i-format',
				'label' => 'Add New Team'
			    ));?>
		<?=$this->Form->end('Add Team');?>
		<table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Division</th>
			    <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
			<?php
			if(count($teams)>0){
			    foreach ($teams AS $team){
			    ?>
			<tr>
			    <td><?=$team['Team']['name'];?></td>
			    <td><?=$team['Divisions']['name'];?></td>
			    <td>
                                <a href="/admin/team/edit/<?=$team['Team']['team_id'];?>" class="button green">Edit</a>
                            </td>
			</tr>
			<?php
			    }
			} else {
			?>
			    <tr>
				<td colspan="3">No Teams to Display</td>
			    </tr>
			<?php } ?>
		    </tbody>
                    <tfoot>
                    <th colspan="5"><?php echo $this->Paginator->numbers(array('first' => 2, 'last' => 2)); ?></th>
                    </tfoot>
		</table>
	    </div>
        </div>
    </div>
</div>