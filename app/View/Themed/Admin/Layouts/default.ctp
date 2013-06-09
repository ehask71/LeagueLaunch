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
        echo $this->Html->css('reset');
        echo $this->Html->css('grid');
        echo $this->Html->css('uniform.default');
        echo $this->Html->css('chosen');
        //<link rel="stylesheet" href="plugins/jqueryui/all/themes/base/jquery.ui.all.css" />

        echo $this->Html->css('style');
        echo $this->Html->css('config');
        ?>
        <!--[if gte IE 8]><?php echo $this->Html->css('ie8');?><![endif]-->

        <!--============ JQUERY =============-->
        <?php
        echo $this->Html->script('jquery');
        echo $this->Html->script('jquery.uniform');
        echo $this->Html->script('chosen.jquery');
        echo $this->Html->script('jquery.placeholder');
        //<script src="plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        //<script src="plugins/jqueryui/all/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        echo $this->Html->script('http://www.google.com/jsapi');
        //<script type="text/javascript" src="plugins/gvchart/jquery.gvChart-1.0.1.min.js"></script>

        echo $this->Html->script('head_scripts');
        ?>
        <script type="text/javascript">
            gvChartInit();
            jQuery(document).ready(function(){
                jQuery('#myGraph1').gvChart({
                    chartType: 'AreaChart',
                    gvSettings: {
                        vAxis: {title: 'Visitors'},
                        hAxis: {title: 'Month'},
                        width: 450,
                        height: 200
                    }
                });					
					
                jQuery('#myGraph4').gvChart({
                    chartType: 'ColumnChart',
                    gvSettings: {
                        vAxis: {title: 'Visitors'},
                        hAxis: {title: 'Month'},
                        width: 450,
                        height: 200
                    }
                });
            });
        </script>

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
                                <a class="logo" href="index.html"></a>
                                <form method="get" id="searchform" action="#">
                                    <input placeholder="Search..." type="text" name="s" id="s" />
                                </form>
                                <div class="clear"></div>
                            </section>
                            <div>
                                <ul id="menu">
                                    <li><a href="index.html">Dashboard<span class="icon1"></span></a></li>
                                    <li><a href="#">Plugins<span class="icon6"></span></a>
                                        <ul>	 
                                            <li><a href="calendar.html">Advanced calendar</a></li>
                                            <li><a href="file_explorer.html">File explorer</a></li>
                                            <li><a href="charts.html">Charts</a></li>
                                            <li><a href="tables.html">Data Tables</a></li>
                                            <li><a href="lightbox.html">LightBox Evolution</a></li>
                                            <li><a href="alerts.html">Alert messages</a></li>
                                            <li><a href="dialogs.html">Fallr - Dialogs, modal boxes...</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Example forms<span class="icon2"></span></a>
                                        <ul>
                                            <li><a href="forms.html">Basic forms</a></li>
                                            <li><a href="forms_validation.html">Forms validation</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Icons<span class="icon7"></span></a>
                                        <ul>
                                            <li><a href="glyphish_icons.html">Glyphish icons</a></li>
                                            <li><a href="fugue_icons.html">Fugue icons</a></li>
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
        <script src="js/ui_calls.js" type="text/javascript"></script>
        <script src="js/scripts.js" type="text/javascript"></script>
    </body>
</html>