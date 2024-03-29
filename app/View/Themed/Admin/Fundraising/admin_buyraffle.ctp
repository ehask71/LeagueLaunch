<div class="grid_12">
    <div class="box">
        <h2>
            Register Raffle Tickets 
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
                <?=$this->Form->input('product_id',array(
				'label' => 'Ticket',
                                'options' => $products,
                                'class' => 'chzn-select',
                                'style' => 'width: 350px;',
			    ));?>
		<?=$this->Form->input('firstname',array(
				'class' => 'i-format',
				'label' => 'First Name'
			    ));?>
		<?=$this->Form->input('lastname',array(
				'class' => 'i-format',
				'label' => 'Last Name'
			    ));?>
		<?=$this->Form->input('address',array(
				'class' => 'i-format',
				'label' => 'Address'
			    ));?>
		<?=$this->Form->input('address2',array(
				'class' => 'i-format',
				'label' => 'Address 2'
			    ));?>
		<?=$this->Form->input('city',array(
				'class' => 'i-format',
				'label' => 'City'
			    ));?>
		<?=$this->Form->input('state',array(
				'label' => 'State',
                                'options' => Configure::read('States'),
                                'class' => 'chzn-select',
                                'style' => 'width: 350px;',
			    ));?>
                <?=$this->Form->input('zip',array(
				'class' => 'i-format',
				'label' => 'Zip',
                                'type' => 'text'
			    ));?>
		<?=$this->Form->input('email',array(
				'class' => 'i-format',
				'label' => 'Email',
                                'type' => 'text'
			    ));?>
		<?=$this->Form->input('phone',array(
				'class' => 'i-format',
				'label' => 'Phone',
                                'type' => 'text'
			    ));?>
		
		<?php echo $this->Form->end('Purchase'); ?>
	    </div>
	</div>
    </div>
</div>