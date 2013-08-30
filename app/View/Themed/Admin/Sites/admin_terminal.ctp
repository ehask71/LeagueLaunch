<div class="grid_12">
    <div class="box">
        <h2>
            Settings
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <?php
		echo $this->Form->create('Order', array(
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
                <? 
                echo $this->Form->input('creditcard_amount',array(
				'class' => 'i-format',
				'label' => 'Amount',
                                'placeholder' => '10.00',
                                'required' => 'required',
                                'onfocus'=>'this.value=\'\'',
                                'after' => '<small>Only 100.00 (numeric amount)</small></div></div><div class="clear"></div></section>'
			    ));
                echo $this->Form->input('creditcard_number',array(
				'class' => 'i-format',
				'label' => 'Card Number'
			    ));
                echo $this->Form->input('creditcard_month',array('label'=>'Month:','value'=>'01','class'=>'i-format','onfocus'=>'this.value=\'\''));
                echo $this->Form->input('creditcard_year',array('label'=>'Year:','value'=>'2013','class'=>'i-format','onfocus'=>'this.value=\'\''));
                echo $this->Form->input('creditcard_code',array('label'=>'CVV','value'=>'111','class'=>'i-format','onfocus'=>'this.value=\'\''));
                
                echo $this->Form->input('cardholder_firstname',array(
				'class' => 'i-format',
				'label' => 'First Name'
			    ));
                echo $this->Form->input('cardholder_lastname',array(
				'class' => 'i-format',
				'label' => 'Last Name'
			    ));
                echo $this->Form->input('cardholder_address',array(
				'class' => 'i-format',
				'label' => 'Billing Address'
			    ));
                echo $this->Form->input('cardholder_city',array(
				'class' => 'i-format',
				'label' => 'Billing City'
			    ));
                echo $this->Form->input('cardholder_state',array(
				'class' => 'i-format',
				'label' => 'Billing State'
			    ));
                echo $this->Form->input('cardholder_zip',array(
				'class' => 'i-format',
				'label' => 'Billing Zip'
			    ));
                echo $this->Form->input('cardholder_phone',array(
				'class' => 'i-format',
				'label' => 'Phone'
			    ));
                echo $this->Form->input('cardholder_email',array(
				'class' => 'i-format',
				'label' => 'Email'
			    ));
                
                echo $this->Form->end('Submit Payment');
            ?>
            </div>
        </div>
    </div>
</div>