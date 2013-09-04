<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title_for_layout; ?> - powered by LeagueLaunch.Com Technology</title>
	<?php
	echo $this->Html->meta('icon');
	echo $this->Html->meta('keywords', $meta_keywords);
	echo $this->Html->meta('description', $meta_description);
	echo $this->Html->meta('abstract', $meta_abstract);
	?>

        <meta name="author" content="LeagueLaunch.com" />
        <!-- begin css -->
	<?php
	echo $this->CloudFlare->css('/common/css/reset.css');
	echo $this->Html->css('/common/css/960.css');
	echo $this->Html->css('/common/css/elements.css');
	echo $this->Html->css('/common/css/social.css');
	echo $this->Html->css('/common/css/forms.css');
	echo $this->Html->css('style');
	echo $this->Html->css('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/ui-lightness/jquery-ui.min.css');
	echo $this->fetch('css');
	echo $this->Html->css('chosen');
	echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js');
	echo $this->Html->script('//code.jquery.com/jquery-migrate-1.0.0.js');
	echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js');
	echo $this->CloudFlare->script('/js/bPopup.js');
	echo $this->Html->script('/js/jedit.js');
	echo $this->Html->script('/js/jsmodal.js');
	echo $this->Html->script('/js/chosen.jquery.min.js');
	echo $this->fetch('meta');

	echo $this->fetch('script');
	?>
        <!-- begin JS -->
    </head>

    <body>
        <div class="container_16" id="body-container">
	    <noscript>
		    <div class="grid_16_nospace">
			<div class="ll-alert-error" id="flash_msg">
			    You Must Have Javascript Enabled To Use this Site!
			</div>
		    </div>
	    </noscript>
            <!-- begin header -->
            <header>
                <div class="grid_6" >
                    <div id="sub-nav">
			<!--nocache-->
                        <ul id="top-nav">
                            <li><?php
	if ($loggedIn) {
	    echo $this->Html->link('LOGOUT', array('controller' => 'account', 'action' => 'logout'));
	} else {
	    echo $this->Html->link('LOGIN', array('controller' => 'account', 'action' => 'login'));
	}
	?>
                            </li>
                            <li><a href="/register" title="Sign Up with {SITENAME}">SIGNUP</a></li>
                            <li><a href="/contact" title="Contact {SITENAME}">CONTACT</a></li>
                        </ul>
			<!--/nocache-->
                    </div>
                    <div class="clear"></div>
                    <div class="logo-text left">
                        <h1>East</h1>
                        <h1>Little</h1>
                    </div>
                </div>
                <div class="grid_4" >
                    <a href="/" title="Back to The {SITENAME} home page" id="logo"><span>{SITENAME}</span></a>
                </div>
                <div class="grid_6" >
                    <div id="top-search">
                        <ul id="header-search">
                            <li><a href="http://www.facebook.com/pages/East-Bay-Little-League/191231337739?ref=hl" title="Follow {SITENAME} on Facebook" target="_blank" class="follow_facebook"><span>Follow Us On Facebook</span></a></li>
                            <li><a href="//twitter/eastbayll" title="Follow {SITENAME} on Twitter" target="_blank" class="follow_twitter"><span>Follow Us on Twitter</span></a></li>
                            <li>
                                <div id="header-form-wrapper">
                                    <form id="ll-search-form" name="ii-search-form" action="" method="post" enctype="multipart/form-data">
                                        <input type="text" id="ll-search-text" name="ll-search-text" class="header-search-text" />
                                        <button name="ll-search-button" id="ll-search-button" class="header-search-button">&nbsp;</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="logo-text right">
                        <h1>Bay</h1>
                        <h1>League</h1>
                    </div>
                </div>
                <div class="grid_16 clear"></div>
<?php echo $this->element('main_nav'); ?>
            </header>
            <!-- end header -->
            <section class="grid_16">
                <div class="grid_16_nospace" id="carousel-container"></div>
                <!-- Begin Body -->
		<div class="grid_16_nospace">
		    <?php echo $this->Session->flash(); ?>
		<?php echo $this->Session->flash('auth'); ?>
		</div>
<?php echo $this->fetch('content'); ?>  
		<div class="clear"></div>
	    </section>
	    <!-- end body -->
	    <!-- begin footer -->
	    <section class="grid_16" id="footer">
		<div class="grid_4" >
		    <div class="content first">
			<h3>Fan Shop</h3>
		    </div>
		</div>
		<div class="grid_4" >
		    <div class="content">
			<h3>Links</h3>
                        <ul>
                            <li><a href="http://www.littleleague.org/Little_League_Online.htm">Little League Online</a></li>
			    <li><a href="http://www.eteamz.com/fldistrict13/">Florida District 13</a></li>
			    <li><a href="http://www.hillsboroughcounty.org/parks/athletics/">Hillsborough Parks & Rec</a></li>
			    <li><a href="http://goo.gl/maps/heVLz">Boundary Map</a></li>
			    <li><a href="http://www.littleleague.org/Assets/forms_pubs/AgeChartBBandSB.pdf">Age Chart</a></li>
                        </ul>
		    </div>
		</div>
		<div class="grid_4">
		    <div class="content">
			<h3>Navigation</h3>
                        <ul>
                            <li><a href="/account">My Account</a></li>
                            <li><a href="/admin/home">Admin</a></li>
                        </ul>
		    </div>
		</div>
		<div class="grid_4">
		    <div class="content">
			<h3>Contacts</h3>
			<ul>
			    <li>East Bay Little League</li>
			    <li>P.O. Box 2395</li>
			    <li>Riverview FL 33568-2395</li>
			    <li><a href="mailto:info@eastbayll.org">Email</a></li>
			</ul>
		    </div>
		</div>

	    </section>
	    <!-- end footer -->
	</div>
<?php echo $this->fetch('scriptBottom'); ?>
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
