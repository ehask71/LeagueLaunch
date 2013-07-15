<?php
    $this->Html->scriptStart(array('block' => 'scriptBottom'));
    echo "$(function() {
        $('#ll-form-builder').formbuilder({
            'save_url': '/admin/forms/save',
            'load_url': '/admin/forms/load',
            'useJson' : true
        });
	$(function() {
            $('#ll-form-builder ul').sortable({ opacity: 0.6, cursor: 'move
	    $('.chzn-select').chosen();
	    $('.chzn-select-deselect').chosen({allow_single_deselect:true});
	}
    </script>
	});
    });";
    $this->Html->scriptEnd();
    echo $this->Html->css('jquery.formbuilder');
    $this->Html->script('jquery.formbuilder',array('block' => 'scriptTop'));
?>
<div class="grid_12">
    <div class="box">
        <h2>
            <?php echo __('Add New Form');?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <input type="hidden" id="form-site-id" name="form-site-id" value="<?php echo Configure::read('Settings.site_id')?>"/>
                <div id="ll-form-builder"></div>
            </div>
        </div>
    </div>
</div>