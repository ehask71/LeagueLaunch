<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title_for_layout; ?> - powered by LeagueLaunch.Com Technology</title>
	<?php
	echo $this->Html->meta('icon');
	echo $this->Html->meta('keywords', $meta_keywords);
	echo $this->Html->meta('description', $meta_description);
	?>
        <meta name="abstract" content="" />
        <meta name="author" content="LeagueLaunch.com" />
        <!-- begin css -->
	<?php
	echo $this->Html->css('/common/css/reset.css');
	echo $this->Html->css('/common/css/960.css');
	echo $this->Html->css('/common/css/social.css');
	echo $this->Html->css('style');
	echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
        <!-- begin JS -->
    </head>
    <body>
	<div class="container_16" id="body-container">
	    <!-- begin header -->
	    <header>
		<div class="grid_6" >
		    <div id="sub-nav">

		    </div>
		    <div class="clear"></div>
		    <div class="logo-text left">
			<h1>Tomahawk</h1>
			<h1>Challenger</h1>
		    </div>
		</div>
		<div class="grid_4" >
		    <a href="/index.php" title="Back to The {SITENAME} home page" id="logo"><span>{SITENAME}</span></a>
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
			<h1>&nbsp;</h1>
			<h1>&nbsp;</h1>
		    </div>
		</div>
		<div class="grid_16 clear"></div>
		<?php echo $this->element('main_nav'); ?>
	    </header>
	    <!-- end header -->
	    <section class="grid_16">
		<div class="grid_16_nospace" id="carousel-container"></div>
		<!-- Begin Body -->
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->Session->flash('auth'); ?>
		<?php echo $this->fetch('content'); ?>  
		<div class="clear"></div>
	    </section>
	    <!-- end body -->
	    <!-- begin footer -->
	    <section class="grid_16" id="footer">

		<div class="grid_4" >
		    <div class="content first">
			
		    </div>
		</div>
		<div class="grid_4" >
		    <div class="content">
			<h3>Links</h3>
		    </div>
		</div>
		<div class="grid_4">
		    <div class="content">
			<h3>Navigation</h3>
                        <ul>
                            <li><?php echo $this->Html->link('Admin',array('action'=>'index','controller'=>'home','prefix'=>'admin'));?>
                        </ul>
		    </div>
		</div>
		<div class="grid_4">
		    <div class="content">
			<h3>Contacts</h3>
		    </div>
		</div>

	    </section>
	    <!-- end footer -->
	</div>

    </body>
</html>
