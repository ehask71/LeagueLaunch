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
			    ));?>
                <?=$this->Form->input('firstname',array(
				'div' => false,
				'class' => 'i-format',
				'label' => 'First Name',
			    ));?>
                <?=$this->Form->input('lastname',array(
				'div' => false,
				'class' => 'i-format',
				'label' => 'Last Name',
			    ));?>
                <?=$this->Form->input('email',array(
				'div' => false,
				'class' => 'i-format',
				'label' => 'email',
			    ));?>
                <?=$this->Form->input('address',array(
				'div' => false,
				'class' => 'i-format',
				'label' => 'Address',
			    ));?>
                <?=$this->Form->input('address2',array(
				'div' => false,
				'class' => 'i-format',
				'label' => 'Address 2',
			    ));?>
                <?=$this->Form->input('city',array(
				'div' => false,
				'class' => 'i-format',
				'label' => 'City',
			    ));?>
                <?=$this->Form->input('state',array(
				'div' => false,
				'class' => 'i-format',
				'label' => 'State',
			    ));?>
                <?=$this->Form->input('zip',array(
				'div' => false,
				'class' => 'i-format',
				'label' => 'Zip',
			    ));?>
                <?=$this->Form->input('country',array(
				'div' => false,
				'class' => 'i-format',
				'label' => 'Country',
			    ));?>
                <?=$this->Form->input('phone',array(
				'div' => false,
				'class' => 'i-format',
				'label' => 'Phone',
			    ));?>
                <?=$this->Form->input('fax',array(
				'div' => false,
				'class' => 'i-format',
				'label' => 'Fax',
			    ));?>
                <?php echo $this->Form->end('Update'); ?>
            </div>
	</div>
    </div>
</div>