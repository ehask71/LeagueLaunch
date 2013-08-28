<div class="grid_12">
    <div class="box">
        <h2>
            <?= __($title); ?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
		<?php
                echo $this->Form->create('Players', array(
                    'class' => 'form_place',
                    'type' => 'file',
                    'inputDefaults' => array(
                        'div' => false,
                        'label' => false,
                        'before' => '<section class="form_row"><div class="grid_2">',
                        'between' => '</div><div class="grid_10"><div class="block_content">',
                        'after' => '</div></div><div class="clear"></div></section>'
                    )
                ));
                ?>
		<?php echo $this->Form->input('player_id',array('type'=>'hidden','before' => '',
                    'between' => '',
                    'after' => ''));?>
		<?php echo $this->Form->input('user_id',array('type'=>'hidden',
		    'before' => '',
                    'between' => '',
                    'after' => ''));?>
		<?php echo $this->Form->input('site_id',array('type'=>'hidden','value'=>  Configure::read('Settings.site_id'),'before' => '',
                    'between' => '',
                    'after' => ''));?>
		<?php echo $this->Form->input('firstname',array('class'=>'i-format'));?>
		<?php echo $this->Form->input('lastname',array('class'=>'i-format'));?>
		<?php echo $this->Form->input('nickname',array('class'=>'i-format'));?>
		<?php echo $this->Form->input('gender',array('type'=>'select','class'=>'i-format','options'=>array('m'=>'Male','f'=>'Female')));?>
		<?php echo $this->Form->input('birthday',array('class'=>'i-format'));?>
		<?php echo $this->Form->end($title);?>
	    </div>
	</div>
    </div>
</div>