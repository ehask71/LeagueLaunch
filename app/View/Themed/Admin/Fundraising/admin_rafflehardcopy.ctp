<div class="grid_12">
    <div class="box">
        <h2>
            Generate A Hard Copy
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <?php echo $this->Form->create('Raffleticket', array(
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
                <?=$this->Form->input('email',array(
				'label' => 'Email Address',
			    ));?>
                <?=$this->Form->input('type',array(
				'label' => 'Type',
                                'options' => array('hardcopy'=>'Generate Hardcopy','email'=>'Email'),
                                'class' => 'chzn-select',
                                'style' => 'width: 350px;',
			    ));?>
                <?php echo $this->Form->end('Find'); ?>
            </div>
        </div> 
    </div> 
</div>