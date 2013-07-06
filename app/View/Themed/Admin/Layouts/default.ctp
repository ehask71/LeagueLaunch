<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"> 

    <head>
        <?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="" />
        
        <!--========= STYLES =========-->
        <?php
        echo $this->CloudFlare->css('reset');
        echo $this->CloudFlare->css('grid');
        echo $this->CloudFlare->css('uniform.default');
        echo $this->CloudFlare->css('chosen');
        echo $this->Html->css('/js/jqueryui/all/themes/base/jquery.ui.all.css');

        //echo $this->Html->css('style');
	echo $this->CloudFlare->css('style');
        echo $this->CloudFlare->css('config');
        ?>
        <!--[if gte IE 8]><?php echo $this->CloudFlare->css('ie8');?><![endif]-->

        <!--============ JQUERY =============-->
        <?php
        echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
        echo $this->Html->script('jquery.uniform');
        echo $this->Html->script('chosen.jquery');
        echo $this->Html->script('jquery.placeholder');
        echo $this->Html->script('/js/jqueryui/all/jquery-ui-1.8.16.custom.min.js');
        echo $this->Html->script('http://www.google.com/jsapi');
        echo $this->Html->script('/js/gvchart/jquery.gvChart-1.0.1.min');

        echo $this->Html->script('head_scripts');
	echo $this->fetch('scriptTop');
        ?>
        

        <!--=== ENABLE HTML5 TAGS FOR IE ===-->
        <!--[if IE]><?php echo $this->Html->script('html5');?><![endif]-->

        <title>Admin theme </title>
    </head>

    <body>				
        <section class="top_panel">
            <div class="panel_elements">
                <ul class="panel_item">
                    <li><a href="/admin/home/settings">Settings</a></li>
                    <li class="right"><a href="/logout">Logout<span class="logout"></span></a></li>
                </ul>
            </div>
        </section>
        <section id="main_wrapper">
            <section class="wrapper_layout">
                <section class="container">
                    <section class="container_12">
                        <section id="page_content" class="page_content">					
                            <section class="header grid_12">
                                <a class="logo" href="/admin/home"></a>
                                <form method="get" id="searchform" action="#">
                                    <input placeholder="Search..." type="text" name="s" id="s" />
                                </form>
                                <div class="clear"></div>
                            </section>
                            <div>
                                <ul id="menu">
                                    <li><a href="/admin/home">Dashboard<span class="icon1"></span></a></li>
                                    <li><a href="#">Plugins<span class="icon6"></span></a>
                                        <ul>	 
                                            <li><?php echo $this->html->link(__('Fundraisers'),array('prefix'=>'admin','controller'=>'fundraising'));?></li>
                                            <li><?php echo $this->html->link(__('Fundraisers'),array('prefix'=>'admin','controller'=>'fundraising'));?></li>
                                            <li><?php echo $this->html->link(__('Fundraisers'),array('prefix'=>'admin','controller'=>'fundraising'));?></li>
                                            <li><?php echo $this->html->link(__('Fundraisers'),array('prefix'=>'admin','controller'=>'fundraising'));?></li>
                                            <li><?php echo $this->html->link(__('Fundraisers'),array('prefix'=>'admin','controller'=>'fundraising'));?></li>
                                            <li><?php echo $this->html->link(__('Fundraisers'),array('prefix'=>'admin','controller'=>'fundraising'));?></li>
                                            <li><?php echo $this->html->link(__('Fundraisers'),array('prefix'=>'admin','controller'=>'fundraising'));?></li>
                                        </ul>
                                    </li>
                                    <li><?php echo $this->html->link(__('Accounts').'<span class="icon2"></span>',array('prefix'=>'admin','controller'=>'account'),array('escape' => FALSE));?>
                                        <ul>
                                            <li><a href="forms.html">Basic forms</a></li>
                                            <li><a href="forms_validation.html">Forms validation</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="/admin/news"><?=__('News');?><span class="icon7"></span></a>
                                        <ul>
                                            <li><a href="/admin/news"><?=__('Add New');?></a></li>
                                        </ul>
                                    </li>
                                    <li><a href="gallery.html">Image gallery<span class="icon3"></span></a></li>
                                    <li><a href="grid.html">Grid<span class="icon8"></span></a></li>
                                    <li><a href="typography.html">Typography<span class="icon10"></span></a></li>
                                </ul><!--End of #menu-->
                            </div>
                            <div class="clear"></div>
                            <div class="position_search">
                                <div class="positioner">
                                    <a href="index.html"><span>Dashboard</span></a>
                                </div>
                            </div>
				
                            <?php echo $this->Session->flash(); ?>
			    <?php echo $this->fetch('content'); ?>    
                            

                        </section><!-- end of #page_content -->
                    </section><!-- end of #container_12 -->
                </section><!-- end of #container -->
            </section><!-- End of .wrapper_layout -->
        </section><!-- End of #main_wrapper -->
        <?php
	echo $this->Html->script('scripts');
	echo $this->Html->script('ui_calls');
	echo $this->fetch('scriptBottom');
	?>
    </body>
</html>