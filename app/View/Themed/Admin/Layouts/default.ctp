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
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->CloudFlare->css('reset');
        echo $this->CloudFlare->css('grid');
        echo $this->CloudFlare->css('uniform.default');
        echo $this->CloudFlare->css('chosen');
        echo $this->Html->css('/js/jqueryui/all/themes/base/jquery.ui.all.css');

        //echo $this->Html->css('style');
        echo $this->CloudFlare->css('style');
        echo $this->CloudFlare->css('config');
        ?>
        <!--[if gte IE 8]><?php echo $this->CloudFlare->css('ie8'); ?><![endif]-->

        <!--============ JQUERY =============-->
        <?php
        echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
        echo $this->CloudFlare->script('jquery.uniform');
        echo $this->CloudFlare->script('chosen.jquery');
        echo $this->CloudFlare->script('jquery.placeholder');
        echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js');
        echo $this->Html->script('http://www.google.com/jsapi');
        echo $this->CloudFlare->script('/js/gvchart/jquery.gvChart-1.0.1.min');

        echo $this->CloudFlare->script('head_scripts');
        echo $this->fetch('scriptTop');
        ?>


        <!--=== ENABLE HTML5 TAGS FOR IE ===-->
        <!--[if IE]><?php echo $this->CloudFlare->script('html5'); ?><![endif]-->

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
                                <?php echo $this->element('main_nav'); ?>
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
        echo $this->CloudFlare->script('scripts');
        echo $this->CloudFlare->script('ui_calls');
        echo $this->fetch('scriptBottom');
        echo $this->fetch('script');
        ?>

        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-42932858-1']);
            _gaq.push(['_setDomainName', '<?php echo $_SERVER['SERVER_NAME']; ?>']);
            _gaq.push(['_setAllowLinker', true]);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 
                    'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();

        </script>
    </body>
</html>