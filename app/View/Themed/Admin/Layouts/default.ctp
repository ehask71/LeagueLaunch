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
        <!--[if IE]><script src="js/html5.js"></script><![endif]-->

        <title>Admin theme </title>
    </head>

    <body>				
        <section class="top_panel">
            <div class="panel_elements">
                <ul class="panel_item">
                    <li><a href="#">Private messages [14]</a></li>
                    <li><a href="#">System Log [52]</a></li>
                    <li><a href="#">Inactive entries [6]</a></li>
                    <li><a href="#">Comments approval [89]</a></li>
                    <li><a href="#">New users [27]</a></li>
                    <li><a href="#">Settings</a></li>
                    <li class="right"><a href="#">Logout<span class="logout"></span></a></li>
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

                            <div class="grid_12">
                                <div class="box">
                                    <h2>
                                        Statistics
                                        <span class="l"></span><span class="r"></span>
                                    </h2>
                                    <div class="hide"><span class="s">Show</span><span class="h">Hide</span></div>
                                    <div class="block">
                                        <div class="block_in">
                                            <div class="grid_6">
                                                <table id='myGraph1'>
                                                    <caption>Visitors count</caption>
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Jan</th>
                                                            <th>Feb</th>
                                                            <th>Mar</th>
                                                            <th>Apr</th>
                                                            <th>May</th>
                                                            <th>Jun</th>
                                                            <th>Jul</th>
                                                            <th>Aug</th>
                                                            <th>Sep</th>
                                                            <th>Oct</th>
                                                            <th>Nov</th>
                                                            <th>Dec</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th>2010</th>
                                                            <td>125</td>
                                                            <td>185</td>
                                                            <td>327</td>
                                                            <td>359</td>
                                                            <td>376</td>
                                                            <td>398</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                        </tr>
                                                        <tr>
                                                            <th>2009</th>
                                                            <td>1167</td>
                                                            <td>1110</td>
                                                            <td>691</td>
                                                            <td>165</td>
                                                            <td>135</td>
                                                            <td>157</td>
                                                            <td>139</td>
                                                            <td>136</td>
                                                            <td>938</td>
                                                            <td>1120</td>
                                                            <td>55</td>
                                                            <td>55</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="grid_6">
                                                <table id='myGraph4'>
                                                    <caption>Visitors count</caption>
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Jan</th>
                                                            <th>Feb</th>
                                                            <th>Mar</th>
                                                            <th>Apr</th>
                                                            <th>May</th>
                                                            <th>Jun</th>
                                                            <th>Jul</th>
                                                            <th>Aug</th>
                                                            <th>Sep</th>
                                                            <th>Oct</th>
                                                            <th>Nov</th>
                                                            <th>Dec</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th>2010</th>
                                                            <td>125</td>
                                                            <td>185</td>
                                                            <td>327</td>
                                                            <td>359</td>
                                                            <td>376</td>
                                                            <td>398</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                        </tr>
                                                        <tr>
                                                            <th>2009</th>
                                                            <td>1167</td>
                                                            <td>1110</td>
                                                            <td>691</td>
                                                            <td>165</td>
                                                            <td>135</td>
                                                            <td>157</td>
                                                            <td>139</td>
                                                            <td>136</td>
                                                            <td>938</td>
                                                            <td>1120</td>
                                                            <td>55</td>
                                                            <td>55</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End of grid_12 -->
                            <div class="clear"></div>
                            <div class="grid_6">
                                <div class="box">
                                    <h2>
                                        Site content
                                        <span class="l"></span><span class="r"></span>
                                    </h2>
                                    <div class="hide"><span class="s">Show</span><span class="h">Hide</span></div>
                                    <div class="block">
                                        <div class="block_in">
                                            <ul class="site_content">
                                                <li>
                                                    Submited Posts:
                                                    <span class="alignright">
                                                        <a href="#"><mark class="style9">14 unapproved</mark></a>
                                                        <a href="#"><mark class="style5">1629 approved</mark></a>
                                                    </span>
                                                </li>
                                                <li>
                                                    Comments:
                                                    <span class="alignright">
                                                        <a href="#"><mark class="style9">73 pending</mark></a>
                                                        <a href="#"><mark class="style5">629 approved</mark></a>
                                                        <a href="#"><mark class="style10">11 spam</mark></a>
                                                    </span>
                                                </li>
                                                <li>
                                                    Total pages:
                                                    <span class="alignright">
                                                        <a href="#"><mark class="style8">763 pages</mark></a>
                                                        <a href="#"><mark class="style3">4 draft</mark></a>
                                                    </span>
                                                </li>
                                                <li>
                                                    Categories:
                                                    <span class="alignright">
                                                        <a href="#"><mark class="style6">24 with 63 subcategories</mark></a>
                                                    </span>
                                                </li>
                                                <li>
                                                    Tags:
                                                    <span class="alignright">
                                                        <a href="#"><mark class="style3">552 different tags</mark></a>
                                                    </span>
                                                </li>
                                                <li>
                                                    Widgets:
                                                    <span class="alignright">
                                                        <a href="#"><mark class="style5">8 active</mark></a>
                                                        <a href="#"><mark class="style4">35 inactive</mark></a>
                                                    </span>
                                                </li>
                                                <li>
                                                    Plugins:
                                                    <span class="alignright">
                                                        <a href="#"><mark class="style5">7 active</mark></a>
                                                        <a href="#"><mark class="style4">3 inactive</mark></a>
                                                    </span>
                                                </li>
                                                <li>
                                                    Updates:
                                                    <span class="alignright">
                                                        <a href="#"><mark class="style12">3 recomended</mark></a>
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End of grid_6 -->
                            <div class="grid_6">
                                <div class="box">
                                    <h2>
                                        Quick Submit
                                        <span class="l"></span><span class="r"></span>
                                    </h2>
                                    <div class="hide"><span class="s">Show</span><span class="h">Hide</span></div>
                                    <div class="block">
                                        <div class="block_in">
                                            <form class="form_place" action="#">

                                                <section class="form_row">
                                                    <div class="grid_2"><label>Article title:</label></div>
                                                    <div class="grid_10">
                                                        <div class="block_content">
                                                            <input type="text" name="input_example" class="i-format" required="required" />
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                </section>

                                                <section class="form_row">
                                                    <div class="grid_2"><label>Category:</label></div>
                                                    <div class="grid_10">
                                                        <div class="block_content">
                                                            <select data-placeholder="Choose a category..." class="chzn-select-deselect" style="width:220px;" tabindex="1">
                                                                <option value=""></option> 
                                                                <option value="United States">Photoshop tutorials</option> 
                                                                <option value="United States">Web Design</option>
                                                                <option value="United States">Web Development</option>
                                                                <option value="United States">Graphic Art</option>
                                                                <option value="United States">Uncategorized</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                </section>

                                                <section class="form_row">
                                                    <div class="grid_2"><label>Message:</label></div>
                                                    <div class="grid_10">
                                                        <div class="block_content">
                                                            <textarea rows="2" cols="20" style="height:140px;" class="default"></textarea>
                                                        </div>	
                                                    </div>
                                                    <div class="clear"></div>
                                                </section>

                                                <section class="form_row">
                                                    <div class="grid_10 alignright">
                                                        <div class="block_content">
                                                            <input class="button red medium submit alignleft" type="reset" value="Clear" />
                                                            <input class="button blue medium submit alignleft" type="submit" value="Submit" />
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                </section>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End of grid_6 -->
                            <div class="clear"></div>

                            <div class="grid_12">
                                <div class="box">
                                    <h2>
                                        Gallery
                                        <span class="l"></span><span class="r"></span>
                                    </h2>
                                    <div class="block">
                                        <ul class="gallery">
                                            <li><img src="images/assets/2.png" alt="" />
                                                <a href="#" class="img_edit" title="Edit"></a>
                                                <a href="#" class="img_delete" title="Delete"></a>
                                            </li>
                                            <li><img src="images/assets/3.png" alt="" />
                                                <a href="#" class="img_edit" title="Edit"></a>
                                                <a href="#" class="img_delete" title="Delete"></a>
                                            </li>
                                            <li><img src="images/assets/4.png" alt="" />
                                                <a href="#" class="img_edit" title="Edit"></a>
                                                <a href="#" class="img_delete" title="Delete"></a>
                                            </li>
                                            <li><img src="images/assets/2.png" alt="" />
                                                <a href="#" class="img_edit" title="Edit"></a>
                                                <a href="#" class="img_delete" title="Delete"></a>
                                            </li>
                                            <li><img src="images/assets/3.png" alt="" />
                                                <a href="#" class="img_edit" title="Edit"></a>
                                                <a href="#" class="img_delete" title="Delete"></a>
                                            </li>
                                            <li><img src="images/assets/4.png" alt="" />
                                                <a href="#" class="img_edit" title="Edit"></a>
                                                <a href="#" class="img_delete" title="Delete"></a>
                                            </li>
                                            <li><img src="images/assets/2.png" alt="" />
                                                <a href="#" class="img_edit" title="Edit"></a>
                                                <a href="#" class="img_delete" title="Delete"></a>
                                            </li>
                                            <li><img src="images/assets/3.png" alt="" />
                                                <a href="#" class="img_edit" title="Edit"></a>
                                                <a href="#" class="img_delete" title="Delete"></a>
                                            </li>
                                            <li><img src="images/assets/4.png" alt="" />
                                                <a href="#" class="img_edit" title="Edit"></a>
                                                <a href="#" class="img_delete" title="Delete"></a>
                                            </li>
                                            <li><img src="images/assets/2.png" alt="" />
                                                <a href="#" class="img_edit" title="Edit"></a>
                                                <a href="#" class="img_delete" title="Delete"></a>
                                            </li>
                                            <li><img src="images/assets/3.png" alt="" />
                                                <a href="#" class="img_edit" title="Edit"></a>
                                                <a href="#" class="img_delete" title="Delete"></a>
                                            </li>
                                            <li><img src="images/assets/4.png" alt="" />
                                                <a href="#" class="img_edit" title="Edit"></a>
                                                <a href="#" class="img_delete" title="Delete"></a>
                                            </li>
                                            <li><img src="images/assets/2.png" alt="" />
                                                <a href="#" class="img_edit" title="Edit"></a>
                                                <a href="#" class="img_delete" title="Delete"></a>
                                            </li>
                                            <li><img src="images/assets/3.png" alt="" />
                                                <a href="#" class="img_edit" title="Edit"></a>
                                                <a href="#" class="img_delete" title="Delete"></a>
                                            </li>
                                            <li><img src="images/assets/4.png" alt="" />
                                                <a href="#" class="img_edit" title="Edit"></a>
                                                <a href="#" class="img_delete" title="Delete"></a>
                                            </li>
                                            <li><img src="images/assets/2.png" alt="" />
                                                <a href="#" class="img_edit" title="Edit"></a>
                                                <a href="#" class="img_delete" title="Delete"></a>
                                            </li>
                                            <li><img src="images/assets/3.png" alt="" />
                                                <a href="#" class="img_edit" title="Edit"></a>
                                                <a href="#" class="img_delete" title="Delete"></a>
                                            </li>
                                            <li><img src="images/assets/4.png" alt="" />
                                                <a href="#" class="img_edit" title="Edit"></a>
                                                <a href="#" class="img_delete" title="Delete"></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>

                        </section><!-- end of #page_content -->
                    </section><!-- end of #container_12 -->
                </section><!-- end of #container -->
            </section><!-- End of .wrapper_layout -->
        </section><!-- End of #main_wrapper -->
        <script src="js/ui_calls.js" type="text/javascript"></script>
        <script src="js/scripts.js" type="text/javascript"></script>
    </body>
</html>