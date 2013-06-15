<div class="grid_12">
    <div class="box">
        <h2>
            Account Details
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <?php echo $this->Form->create('Sites', array(
			    'class' => 'form_place',
			    'type' => 'file',
                            'inputDefaults' => array(
                                'label' => false,
                                'before' => '<section class="form_row"><div class="grid_2">',
                                'between' => '</div><div class="grid_10"><div class="block_content">',
				'after' => '</div></div><div class="clear"></div></section>'
                            )
			));?>
                <?=$this->Form->input('domain',array(
				'div' => false,
				'class' => 'i-format',
				'label' => 'Description',
				//'before' => '<section class="form_row"><div class="grid_2">',
				//'between' => '</div><div class="grid_10"><div class="block_content">',
				'after' => '<small>Domain</small></div></div><div class="clear"></div></section>'
			    ));?>
                <?=$this->Form->input('leaguename',array(
				'div' => false,
				'class' => 'i-format',
				'label' => 'League Name',
				//'before' => '<section class="form_row"><div class="grid_2">',
				//'between' => '</div><div class="grid_10"><div class="block_content">',
				'after' => '<small>League Name</small></div></div><div class="clear"></div></section>'
			    ));?>
                <?=$this->Form->input('sport',array(
				//'type' => 'select',
				'options' => array('baseball'=>'baseball','football'=>'football','soccer'=>'soccer'),
				'div' => false,
				'class' => 'chzn-select-deselect',
				'style'=> 'width:350px',
				'label' => 'Sport',
				//'before' => '<section class="form_row"><div class="grid_2">',
				//'between' => '</div><div class="grid_10"><div class="block_content">',
				'after' => '<br/><small>Your Leagues Sport</small></div></div><div class="clear"></div></section>'
			    ));?>
                <?=$this->Form->input('organization',array(
				'div' => false,
				'class' => 'i-format',
				'label' => 'Organization',
				//'before' => '<section class="form_row"><div class="grid_2">',
				//'between' => '</div><div class="grid_10"><div class="block_content">',
				//'after' => '</div></div><div class="clear"></div></section>'
			    ));?>
                <?=$this->Form->input('slogan',array(
				'div' => false,
				'class' => 'i-format',
				'label' => 'Slogan',
				//'before' => '<section class="form_row"><div class="grid_2">',
				//'between' => '</div><div class="grid_10"><div class="block_content">',
				//'after' => '</div></div><div class="clear"></div></section>'
			    ));?>
                <?php echo $this->Form->end('Update'); ?>
            </div>
	</div>
    </div>
</div>