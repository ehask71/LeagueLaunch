<?php
$this->Html->scriptStart(array('block' => 'scriptBottom'));
    echo "$(function() {
	$( '#startDate' ).datepicker({ dateFormat: 'yy-mm-dd' });
	$( '#endDate' ).datepicker({ dateFormat: 'yy-mm-dd' });
	$( '#eventDate' ).datepicker({ dateFormat: 'yy-mm-dd' });
        window.onload = function(){
             CKEDITOR.replace( 'ckeditor', { toolbar : 'Normal' } );
        };
});";
    $this->Html->scriptEnd();
    echo $this->Html->script('/ckeditor/ckeditor');
?>
<div class="grid_12">
    <div class="box">
        <h2>
            New Fundraiser
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
		<?php echo $this->Form->create('Fundraiser', array(
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
		<?=$this->Form->input('name',array(
				'class' => 'i-format',
				'label' => 'Name',
				'after' => '<small>Fundraiser Title/Name (will be on tickets)</small></div></div><div class="clear"></div></section>'
			    ));?>
		<?/*=$this->Media->ckeditor('description',array(
				'rows' => 5,
				'cols' => 80,
				'label' => 'Description') );*/?>
                <?=$this->Form->input('description',array(
				'class' => 'ckeditor',
				'id' => 'editor1',
				'rows' => 5,
				'cols' => 80,
				'label' => 'Description',
				'type' => 'textarea',
			    ));?>
		<?=$this->Form->input('type',array(
				//'type' => 'select',
				'options' => array(''=>'Select','raffle'=>'Raffle','pokerrun'=>'Poker Run'),
				'class' => 'chzn-select-deselect',
				'style'=> 'width:350px',
				'label' => 'Type',
				'after' => '<br/><small></small></div></div><div class="clear"></div></section>'
			    ));?>
		<?=$this->Form->input('start',array(
				'class' => 'input200',
				'id' => 'startDate',
				'label' => 'Start Date',
				'type' => 'text'
			    ));?>
		<?=$this->Form->input('end',array(
				'class' => 'input200',
				'id' => 'endDate',
				'label' => 'End Date',
				'type' => 'text'
			    ));?>
		<?=$this->Form->input('event_date',array(
				'class' => 'input200',
				'id' => 'eventDate',
				'label' => 'Event Date',
				'type' => 'text'
			    ));?>
		<?=$this->Media->ckeditor('event_location',array(
				'rows' => 5,
				'cols' => 80,
				'label' => 'Event Location') );?>
		<?/*=$this->Media->ckeditor('disclaimer',array(
				'rows' => 5,
				'cols' => 80,
				'label' => 'Disclaimer') );*/?>
                
		<?=$this->Form->input('provider',array(
				//'type' => 'select',
				'options' => array('local'=>'Local','pokerrun'=>'PokerRun.org'),
				'class' => 'chzn-select-deselect',
				'style'=> 'width:350px',
				'label' => 'Provider',
				'after' => '<br/><small></small></div></div><div class="clear"></div></section>'
			    ));?>
		<?=$this->Form->input('create_product',array(
				//'type' => 'select',
				'options' => array('yes'=>'Yes','no'=>'No'),
				'class' => 'chzn-select-deselect',
				'style'=> 'width:350px',
				'label' => 'Create A Product?',
				'after' => '<br/><small></small></div></div><div class="clear"></div></section>'
			    ));?>
		<?/*$this->Form->input('product_category',array(
				//'type' => 'select',
				'options' => $categories,
				'class' => 'chzn-select-deselect',
				'style'=> 'width:350px',
				'label' => 'Product Category',
				'after' => '<br/><small></small></div></div><div class="clear"></div></section>'
			    ));*/?>
		<?=$this->Form->input('site_id',array(
                                'type' => 'hidden',
                                'before' => '',
                                'between' => '',
				'after' => ''
			    ));?>
		<?php echo $this->Form->end('Create'); ?>
	    </div>
	</div>
    </div>
</div>