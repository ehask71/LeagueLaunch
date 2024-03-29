<?php
    $this->Html->scriptStart(array('block' => 'scriptBottom'));
    echo "$(function() {
	$( '#startDate' ).datepicker({ dateFormat: 'yy-mm-dd' });
	$( '#endDate' ).datepicker({ dateFormat: 'yy-mm-dd' });
	window.onload = function(){
             CKEDITOR.replace( 'ckeditor', { toolbar : 'Normal' } );
        };
    });";
    $this->Html->scriptEnd();
    $this->Html->script('/ckeditor/ckeditor.js',array('block' => 'scriptTop'));
?>
<div class="grid_12">
    <div class="box">
        <h2>
            <?=__('News');?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
		<?php echo $this->Form->create('News', array(
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
		<?=$this->Form->input('title',array(
				'class' => 'i-format',
				'label' => 'Title'
			    ));?>
		<?=$this->Form->input('start_date',array(
				'class' => 'input200',
				'id' => 'startDate',
				'label' => 'Start Date',
				'type' => 'text'
			    ));?>
		<?=$this->Form->input('end_date',array(
				'class' => 'input200',
				'id' => 'endDate',
				'label' => 'End Date',
				'type' => 'text'
			    ));?>
		<?=$this->Form->input('content',array(
				'class' => 'ckeditor',
				'id' => 'editor1',
				'rows' => 10,
				'cols' => 80,
				'label' => 'Content',
				'type' => 'textarea',
			    ));?>
		<?php echo $this->Form->end('Add News'); ?>
            </div>
        </div>
    </div>
</div>