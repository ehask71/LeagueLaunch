<div class="grid_12">
    <div class="box">
        <h2>
            <?= __('Add New Registration'); ?>
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
                
                ?>
            </div>
        </div>
    </div>
</div>