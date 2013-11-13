<div class="grid_12">
    <div class="box">
        <h2>
            <?= __('Edit Division'); ?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <?php
                echo $this->Form->create('Divisions', array(
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
                $this->Form->input('site_id', array(
                    'type' => 'hidden',
                    'before' => '',
                    'between' => '',
                    'after' => ''
                ));
                ?>
                <?=
                $this->Form->input('division_id', array(
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
                $this->Form->input('age', array(
                    'class' => 'i-format',
                    'label' => 'League Ages (ex: 14,15)'
                ));
                ?>
                <?=
                $this->Form->input('leagueage', array(
                    'class' => 'i-format',
                    'label' => 'League Age'
                ));
                ?>
                <?=
                $this->Form->input('leagueage_cutoff', array(
                    'class' => 'i-format',
                    'label' => 'League Ages (ex: 14,15)'
                ));
                ?>
                <?=
                $this->Form->input('parent', array(
                    'class' => 'i-format',
                    'label' => 'Parent Division',
                    'options' => $divdropdown
                ));
                ?>
<?php echo $this->Form->end(__('Edit Division')); ?>
            </div>
        </div> 
    </div> 
</div>