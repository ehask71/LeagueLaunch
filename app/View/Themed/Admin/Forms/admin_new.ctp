<?php
    $this->Html->scriptStart(array('block' => 'scriptBottom'));
    echo "$(function() {
        $('#my-form-builder').formbuilder({
            'save_url': 'example-save.php',
            'load_url': 'example-json.php',
            'useJson' : true
        });
	$(function() {
            $('#ll-form-builder ul').sortable({ opacity: 0.6, cursor: 'move'});
	});
    });";
    $this->Html->scriptEnd();
    $this->Html->css('jquery.formbuilder');
    $this->Html->script('jquery.formbuilder',array('block' => 'scriptTop'));
?>
<div class="grid_12">
    <div class="box">
        <h2>
            <?php echo __d('Add New Form');?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <div id="ll-form-builder"></div>
            </div>
        </div>
    </div>
</div>