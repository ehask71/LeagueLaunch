<?php
$this->Html->scriptStart(array('block' => 'scriptBottom'));
echo "$(function() {
	$( '#startDate' ).datepicker({ dateFormat: 'yy-mm-dd' });
	$( '#endDate' ).datepicker({ dateFormat: 'yy-mm-dd' });
    });";
$this->Html->scriptEnd();
?>
<div class="grid_12">
    <div class="box">
        <h2>
            <?= __('Add New Registration ~ Step 1'); ?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <?php
                echo $this->Form->create('Registration', array("type" => "file", "id" => "newRegistration",
                    'inputDefaults' => array(
                        'div' => false,
                        'label' => false,
                        'before' => '<section class="form_row"><div class="grid_2">',
                        'between' => '</div><div class="grid_10"><div class="block_content">',
                        'after' => '</div></div><div class="clear"></div></section>'
                        )));
                echo $this->Form->input('name',array('type' => 'text'));
                echo $this->Form->input('startdate', array('type' => 'text','label'=>'Start Date','id' => 'startDate', 'class' => 'input200'));
                echo $this->Form->input('enddate', array('type' => 'text','label'=>'End Date','id' => 'endDate', 'class' => 'input200'));
                echo $this->Form->input('active', array(
                    'type' => 'select',
                    'class' => 'chzn-select',
                    'style' => 'width:350px',
                    'options' => array(1 => 'Yes', 0 => 'No')
                ));
                echo $this->Form->input('site_id', array('type' => 'hidden', 'value' => Configure::read('Settings.site_id')));
                echo $this->Form->end('Save Event');
                ?>
            </div>
        </div>
    </div>
</div>