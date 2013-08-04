<div class="grid_12">
    <div class="box">
        <h2>
            <?= __($heading); ?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <?php
                echo $this->Form->create('Season', array(
                    'class' => 'form_place',
                    'type' => 'file',
                    'inputDefaults' => array(
                        'div' => false,
                        'label' => false,
                        'before' => '<section class="form_row"><div class="grid_2">',
                        'between' => '</div><div class="grid_10"><div class="block_content">',
                        'after' => '</div></div><div class="clear"></div></section>'
                    )
                ));
                ?>
                <?=
                $this->Form->input('id', array(
                    'type' => 'hidden',
                    'before' => '',
                    'between' => '',
                    'after' => ''
                ));
                ?>
                <?=
                $this->Form->input('name', array(
                    'class' => 'i-format',
                    'label' => 'Name'
                ));
                ?>
                <?=
                $this->Form->input('startdate', array(
                    'class' => 'i-format',
                    'label' => 'Start Date'
                ));
                ?>
                <?=
                $this->Form->input('enddate', array(
                    'class' => 'i-format',
                    'label' => 'End Date'
                ));
                ?>
                <?=
                $this->Form->input('registration_start', array(
                    'class' => 'i-format',
                    'label' => 'Registration Starts'
                ));
                ?>
                <?=
                $this->Form->input('registration_ends', array(
                    'class' => 'i-format',
                    'label' => 'Registration Ends'
                ));
                ?>
                <?=
                $this->Form->input('active', array(
                    'class' => 'i-format',
                    'label' => 'Active',
                    'options' => array(0 => 'No', 1 => 'Yes')
                ));
                ?>
                <?php echo $this->Form->end(__('Edit Season')); ?>
            </div>
        </div> 
    </div> 
</div>