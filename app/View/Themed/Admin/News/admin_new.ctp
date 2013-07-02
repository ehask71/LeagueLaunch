<?php
    $this->Html->script('wysiwyg', array('block' => 'scriptBottom'));
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
				'class' => 'input200 hasDatepicker',
				'id' => 'startDate',
				'label' => 'Start Date'
			    ));?>
		<?=$this->Form->input('end_date',array(
				'class' => 'input200 hasDatepicker',
				'id' => 'endDate',
				'label' => 'End Date'
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
<script type="text/javascript">
$(function() {
	$( "#startDate" ).datepicker();
	$( "#endDate" ).datepicker();
});
</script>