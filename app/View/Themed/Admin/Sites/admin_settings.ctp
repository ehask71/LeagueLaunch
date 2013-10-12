<div class="grid_12">
    <div class="box">
        <h2>
            Settings
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
		<?php
			echo $this->Form->create('Settings', array(
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
		<div class="accordion">
			<h3><a href="#">Basic Info</a></h3>
			<div>
			    <?=$this->Form->input('meta_keywords',array(
				'class' => 'i-format',
				'label' => 'Keywords',
				'after' => '<small>Comma Seperated</small></div></div><div class="clear"></div></section>'
			    ));?>
			    <?=$this->Form->input('meta_description',array(
				'class' => 'i-format',
				'label' => 'Description',
				'after' => '<small>League Description</small></div></div><div class="clear"></div></section>'
			    ));?>
			</div>
			<h3><a href="#">League Age</a></h3>
			<div>
			    <?=$this->Form->input('leagueage|use_leagueage',array(
                                'id'=>'leagueage_use_leagueage',
                                'options' => array('true'=>'True','false'=>'False'),
				'class' => 'chzn-select',
                                'style' => 'width: 350px;',
				'label' => 'Use League Age',
				'after' => '<br><small>If you want the system to attempt to use calculated league age</small></div></div><div class="clear"></div></section>'
			    ));?>
                            <?=$this->Form->input('leagueage|allow_on_error',array(
                                'id'=>'leagueage_allow_on_error',
                                'options' => array('true'=>'True','false'=>'False'),
				'class' => 'chzn-select',
                                'style' => 'width: 350px;',
				'label' => 'Show All on Error',
				'after' => '<br><small>If you want the system to show all available divisions if unable to determine league age.<br><b>Use League Age must be True</b></small></div></div><div class="clear"></div></section>'
			    ));?>
			</div>
			<h3><a href="#">Payment Options</a></h3>
			<div>
			    <?=$this->Form->input('authorize_net_enabled',array(
                                'id'=>'authorize_net_enabled',
                                'options' => array('true'=>'True','false'=>'False'),
				'class' => 'chzn-select',
                                'style' => 'width: 350px;',
				'label' => 'Authorize.Net Enabled',
				'after' => '<br><small>If you want the system to attempt to use calculated league age</small></div></div><div class="clear"></div></section>'
			    ));?>
                            <?=$this->Form->input('authorize_net_login',array(
				'class' => 'i-format',
				'label' => 'Auth.Net Login',
				'after' => '<small>Api Login</small></div></div><div class="clear"></div></section>'
			    ));?>
                            <?=$this->Form->input('authorize_net_txnkey',array(
				'class' => 'i-format',
				'label' => 'Auth.Net Txn Key',
				'after' => '<small>API Transaction Key</small></div></div><div class="clear"></div></section>'
			    ));?>
                            <?=$this->Form->input('authorize_net_api_url',array(
				'class' => 'i-format',
				'label' => 'Auth.Net URL',
				'after' => '<small>API URL</small></div></div><div class="clear"></div></section>'
			    ));?>
			</div>
		</div>
		<?php echo $this->Form->end(array(
                        'label' => 'Update',
                        'div' => array(
                            'class' => 'grid_12',
			    'style' => 'padding-top:20px;'
                        )
                     )); ?>
	    </div>
	</div>
    </div>
</div>