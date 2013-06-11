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
			/*echo $this->Form->create(NULL, array(
			    'class' => 'form_place',
			    'type' => 'file'
			));*/?>
			<ul>
			    <li><a href="#tabs-1">Basic Info</a></li>
			    <li><a href="#tabs-2">Proin dolor</a></li>
			    <li><a href="#tabs-3">Aenean lacinia</a></li>
			</ul>
			<div id="tabs-1">
			    <?=$this->Form->input('Setting.meta_keywords',array(
				'div' => false,
				'class' => 'i-format',
				'label' => 'Keywords',
				'before' => '<section class="form_row"><div class="grid_2">',
				'between' => '</div><div class="grid_10"><div class="block_content">',
				'after' => '<small>Comma Seperated</small?</div></div><div class="clear"></div></section>'
			    ));?>
			    <?=$this->Form->input('Settings.meta_description',array(
				'div' => false,
				'class' => 'i-format',
				'label' => 'Description',
				'before' => '<section class="form_row"><div class="grid_2">',
				'between' => '</div><div class="grid_10"><div class="block_content">',
				'after' => '<small>League Description</small?</div></div><div class="clear"></div></section>'
			    ));?>
			    <?=$this->Form->input('Sites.sport',array(
				//'type' => 'select',
				'options' => array('baseball','football','soccer'),
				'div' => false,
				'class' => 'chzn-select-deselect',
				'style'=> 'width:350px',
				'label' => 'Sport',
				'before' => '<section class="form_row"><div class="grid_2">',
				'between' => '</div><div class="grid_10"><div class="block_content">',
				'after' => '<small>Your Leagues Sport</small?</div></div><div class="clear"></div></section>'
			    ));?>
			    <section class="form_row">
				<div class="grid_2"><label>Input:</label></div>
				<div class="grid_10">
				    <div class="block_content">
					<input type="text" required="required" class="i-format" name="input_example">
				    </div>
				</div>
				<div class="clear"></div>
			    </section>
			</div>
			<div id="tabs-2">
			    <h2>Content heading 2</h2>
			    <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
			</div>
			<div id="tabs-3">
			    <h2>Content heading 3</h2>
			    <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
			    <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
			</div>
		    <?php /*echo $this->Form->end('Update');*/ ?>
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