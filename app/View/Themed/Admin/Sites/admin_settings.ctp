<div class="grid_12">
    <div class="box">
        <h2>
            Settings
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
		<style type="text/css">
		    /*.ui-tabs-vertical { width: 55em; } */
		    .ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em; }
		    .ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
		    .ui-tabs-vertical .ui-tabs-nav li a { display:block; }
		    .ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; border-right-width: 1px; }
		    .ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: 58em;}
		</style>
		<div id="tabs">
		    <!--<form class="form_place" action="#">-->
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
			<ul>
			    <li><a href="#tabs-1">Basic Info</a></li>
			    <li><a href="#tabs-2">League Age</a></li>
			    <li><a href="#tabs-3">Payment</a></li>
			</ul>
			<div id="tabs-1">
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
			<div id="tabs-2">
			    <?=$this->Form->input('leagueage~use_leagueage',array(
                                'options' => array('true'=>'True','false'=>'False'),
				'class' => 'chzn-select',
                                'style' => 'width: 350px;',
				'label' => 'Use League Age',
				'after' => '<br><small>If you want the system to attempt to use calculated league age</small></div></div><div class="clear"></div></section>'
			    ));?>
                            <?=$this->Form->input('leagueage~allow_on_error',array(
                                'options' => array('true'=>'True','false'=>'False'),
				'class' => 'chzn-select',
                                'style' => 'width: 350px;',
				'label' => 'Show All on Error',
				'after' => '<br><small>If you want the system to show all available divisions if unable to determinr league age.<b>Use League Age must be True</b></small></div></div><div class="clear"></div></section>'
			    ));?>
			</div>
			<div id="tabs-3">
			    <h2>Payment Options</h2>
			    <p>Coming Soon</p>
			</div>
		    <?php echo $this->Form->end(array(
                        'label' => 'Update',
                        'div' => array(
                            'class' => 'grid_12'
                        )
                     )); ?>
		</div>
		<script type="text/javascript">
		    $(function() {
			$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
			$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
		    });
		</script>
	    </div>
	</div>
    </div>
</div>