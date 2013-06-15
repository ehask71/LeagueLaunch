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
                                'div' => false,
                                'label' => false,
                                'before' => '<section class="form_row"><div class="grid_2">',
                                'between' => '</div><div class="grid_10"><div class="block_content">',
				'after' => '</div></div><div class="clear"></div></section>'
                            )
			));?>
                <?=$this->Form->input('domain',array(
				'class' => 'i-format',
				'label' => 'Description',
				'after' => '<small>Domain</small></div></div><div class="clear"></div></section>'
			    ));?>
                <?=$this->Form->input('leaguename',array(
				'class' => 'i-format',
				'label' => 'League Name',
				'after' => '<small>League Name</small></div></div><div class="clear"></div></section>'
			    ));?>
                <?=$this->Form->input('sport',array(
				//'type' => 'select',
				'options' => array('baseball'=>'baseball','football'=>'football','soccer'=>'soccer'),
				'class' => 'chzn-select-deselect',
				'style'=> 'width:350px',
				'label' => 'Sport',
				'after' => '<br/><small>Your Leagues Sport</small></div></div><div class="clear"></div></section>'
			    ));?>
                <?=$this->Form->input('organization',array(
				'class' => 'i-format',
				'label' => 'Organization',
			    ));?>
                <?=$this->Form->input('slogan',array(
				'class' => 'i-format',
				'label' => 'Slogan',
			    ));?>
                <?=$this->Form->input('firstname',array(
				'class' => 'i-format',
				'label' => 'First Name',
			    ));?>
                <?=$this->Form->input('lastname',array(
				'class' => 'i-format',
				'label' => 'Last Name',
			    ));?>
                <?=$this->Form->input('email',array(
				'class' => 'i-format',
				'label' => 'Email',
			    ));?>
                <?=$this->Form->input('address',array(
				'class' => 'i-format',
				'label' => 'Address',
			    ));?>
                <?=$this->Form->input('address2',array(
				'class' => 'i-format',
				'label' => 'Address 2',
			    ));?>
                <?=$this->Form->input('city',array(
				'class' => 'i-format',
				'label' => 'City',
			    ));?>
                <?=$this->Form->input('state',array(
				'class' => 'i-format',
				'label' => 'State',
			    ));?>
                <?=$this->Form->input('zip',array(
				'class' => 'i-format',
				'label' => 'Zip',
			    ));?>
                <?=$this->Form->input('country',array(
				'class' => 'i-format',
				'label' => 'Country',
			    ));?>
                <?=$this->Form->input('phone',array(
				'class' => 'i-format',
				'label' => 'Phone',
			    ));?>
                <?=$this->Form->input('fax',array(
				'class' => 'i-format',
				'label' => 'Fax',
			    ));?>
                <?=$this->Form->input('site_id',array(
                                'type' => 'hidden',
			    ));?>
                <?php echo $this->Form->end('Update'); ?>
            </div>
	</div>
    </div>
</div>