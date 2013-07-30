<?php
$this->Html->scriptStart(array('block' => 'scriptBottom'));
echo "$(function() {
        $('#ll-form-builder').formbuilder({
            'save_url': '/admin/forms/save/',
            'load_url': '/admin/forms/load/',
            'useJson' : true
        });
	$(function() {
            $('#ll-form-builder ul').sortable({ opacity: 0.6, cursor: 'move'});
	    $('.chzn-select').chosen();
	    $('.chzn-select-deselect').chosen({allow_single_deselect:true});
	});
    });";
$this->Html->scriptEnd();
echo $this->Html->css('jquery.formbuilder');
$this->Html->script('jquery.formbuilder', array('block' => 'scriptTop'));
?>
<div class="grid_12">
    <div class="box">
        <h2>
            <?php echo __('Add New Form'); ?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <?php
                echo $this->Form->create('Forms', array("type" => "file", "id" => "dynamicForm",
                    'inputDefaults' => array(
                        'div' => false,
                        'label' => false,
                        'before' => '<section class="form_row"><div class="grid_2">',
                        'between' => '</div><div class="grid_10"><div class="block_content">',
                        'after' => '</div></div><div class="clear"></div></section>'
                        )));
                ?>
		<?php 
		echo $this->Form->input('id', array(
		    'type' => 'hidden',
		    'id' => 'formId'
		));
		//echo $this->Form->input('formdisplayurl',array('label'="Form Url",'value'=>$this->webroot.'/forms/'));
                echo $this->Form->input('name', array('type'=>'text','label'=>'Form Name'));
		echo $this->Form->input('type',array('type'=>'select','options'=>array('standard'=>'Standard','contact'=>'Contact','registration'=>'Registration')));	
			?>
                <input type="hidden" id="form-site-id" name="site_id" value="<?php echo Configure::read('Settings.site_id') ?>"/>
                <div id="ll-form-builder" style="min-height: 300px;"></div>
                <? echo $this->Form->end(); ?>
                <a class="btn btn-primary" id="save_survey_form" type="submit">Save</a>
            </div>
        </div>
    </div>
</div>