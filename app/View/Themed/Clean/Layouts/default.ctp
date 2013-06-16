<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Clean Sport</title>
	<meta name="description" content="This is a sport website template">
	<meta name="author" content="The author of this template is (sheko_elanteko)">

	<!-- Mobile Specific Metas
  ================================================== -->
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> -->

	<!-- CSS
  ================================================== -->
        <?php
		echo $this->Html->meta('icon');
                echo $this->Html->css('basic-styles');
                echo $this->Html->css('main');
                echo $this->Html->css('home');
                echo $this->Html->meta('keywords',$meta_keywords);
                echo $this->Html->meta('description',$meta_description);
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

	<!--[if lt IE 9]>
                <?php 
		echo $this->Html->script('http://html5shim.googlecode.com/svn/trunk/html5.js');
		echo $this->Html->css('ie_fix');
                ?>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

</head>
<body>

<!-- To Top button -->
<a href="#top" id="toTop">&#8593;</a>


	<!-- Page Layout
	================================================== -->

	<!-- Header Styles -->
	<header id="mainHeader" class="expand">
		<div class="topHeader expand">
			<div class="topNav container">
				<ul>
					<li><a href="index.html">Home</a></li>
					<li><a href="about.html">About</a></li>
					<li><a href="blog.html">Blog</a></li>
					<li><a href="gallery_1.html">Gallery</a></li>
					<li><a href="#">TV</a></li>
					<li><a href="#">Radio</a></li>
					<li><a href="#">Help & Forum</a></li>
					<li class="last"><a href="contact.html">Contact</a></li>
				</ul>
			</div>
		</div>
		<div class="container">
			<div id="logo" class="eight columns">
				<h1><a href="index.html">Clean Sport <em>A new sport news website</em></a></h1>
			</div>
			<div class="searchBox eight columns">
				<form method="post" action="#">
					<input type="text" name="headerSearch" id="headerSearch" placeholder="search...">
					<input type="submit" name="submitSearch" id="submitSearch" class="noTransition" value="Search">
				</form>
			</div>
		</div>
	</header>
	<hr><!-- end header section -->


	<nav id="mainNav" class="container">
		<ul>
			<li><a class="current" href="index.html">Home</a></li>
			<li><a href="football.html">Football</a></li>
			<li><a href="football.html">Basketball</a></li>
			<li><a href="football.html">Tennis</a></li>
			<li><a href="football.html">Golf</a></li>
			<li><a href="football.html">Racing</a></li>
			<li><a href="football.html">Olympics</a></li>
			<li><a href="#">Pages&#8595;</a>
				<ul>
					<li><a href="about.html">About</a></li>
					<li><a href="blog.html">Blog</a></li>
					<li><a href="post.html">Post</a></li>
					<li><a href="gallery_1.html">Gellery 1</a></li>
					<li><a href="gallery_2.html">Gellery 2</a></li>
					<li><a href="contact.html">Contact</a></li>
				</ul>
			</li>
			<li><a href="#">Sport Pages&#8595;</a>
				<ul>
					<li><a href="football.html">Football</a></li>
					<li><a href="league_news.html">League News</a></li>
					<li><a href="league_teams.html">League Teams</a></li>
					<li><a href="league_fixtures.html">League Fixtures</a></li>
					<li><a href="league_tables.html">League Tables</a></li>
					<li><a href="league_topScorers.html">League Top Scorers</a></li>
					<li><a href="league_photos.html">League Photos</a></li>
					<li><a href="league_photos_2.html">League Photos 2</a></li>
					<li><a href="league_photos_3.html">League Photos 3</a></li>
					<li><a href="player_profile.html">Player Profile</a></li>
					<li><a href="team_info.html">Team Info</a></li>
				</ul>
			</li>
		</ul>
	</nav><!-- end main nav section -->

	<div id="contetnContainer" class="container">
        <?php echo $this->Session->flash(); ?>
            <?php echo $this->Session->flash('auth'); ?>
	<?php echo $this->fetch('content'); ?>    
        </div><!-- end of content container -->



	<section id="footer" class="expand">
		<div class="footerUpper container">
			<section class="footerAbout five columns">
				<h1><a href="index.html">Clean Sport <em>A new sport news website</em></a></h1>
				<p>Nam et commodo est. Nulla tortor leo, fringilla ac pulvinar ut, tincidunt eget nisl. Vivamus augue tellus, posuere id consequat vel, hendrerit nec turpis. Fusce ut justo non sem elementum dapibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra.</p>
				<a href="#" class="login">Login</a>
				<a href="#" class="join">Join</a>
			</section><!-- footer about -->
			<section class="footerNav two columns">
				<header class="reverse">
					<h2>Nav</h2>
				</header>
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">About</a></li>
					<li><a href="#">Blog</a></li>
					<li><a href="#">Gallery</a></li>
					<li><a href="#">TV</a></li>
					<li><a href="#">Radio</a></li>
					<li><a href="#">Forum</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
			</section><!-- footer nav -->
			<section class="flickrFeed four columns">
				<header class="reverse">
					<h2>Flickr Feed</h2>
				</header>
				<ul>
					<li><a href="#"><img src="images/flickr_image.jpg" alt=""></a></li>
					<li><a href="#"><img src="images/flickr_image.jpg" alt=""></a></li>
					<li><a href="#"><img src="images/flickr_image.jpg" alt=""></a></li>
					<li><a href="#"><img src="images/flickr_image.jpg" alt=""></a></li>
					<li><a href="#"><img src="images/flickr_image.jpg" alt=""></a></li>
					<li><a href="#"><img src="images/flickr_image.jpg" alt=""></a></li>
					<li><a href="#"><img src="images/flickr_image.jpg" alt=""></a></li>
					<li><a href="#"><img src="images/flickr_image.jpg" alt=""></a></li>
					<li><a href="#"><img src="images/flickr_image.jpg" alt=""></a></li>
				</ul>
			</section><!-- flickr feed -->
			<section class="usefulLinks five columns">
				<header class="reverse">
					<h2>Useful Links</h2>
				</header>
				<ul>
					<li><a href="#">Nam felis nibh, sollicitudin quis pulvinar.</a></li>
					<li><a href="#">Nam felis nibh, sollicitudin quis pulvinar.</a></li>
					<li><a href="#">Nam felis nibh, sollicitudin quis pulvinar.</a></li>
					<li><a href="#">Nam felis nibh, sollicitudin quis pulvinar.</a></li>
					<li><a href="#">Nam felis nibh, sollicitudin quis pulvinar.</a></li>
					<li><a href="#">Nam felis nibh, sollicitudin quis pulvinar.</a></li>
					<li><a href="#">Nam felis nibh, sollicitudin quis pulvinar.</a></li>
				</ul>
			</section><!-- useful links -->
		</div><!-- end of footerUpper div -->
		<div class="footerBottom expand">
			<div class="container">
				<div class="footerSocial eight columns">
					<ul>
						<li><a href="#" class="facebook">Facebook</a></li>
						<li><a href="#" class="twitter">Twitter</a></li>
						<li><a href="#" class="google">Google +</a></li>
						<li><a href="#" class="vimeo">Vimeo</a></li>
						<li><a href="#" class="flickr">Flickr</a></li>
					</ul>
				</div><!-- footer social -->
				<div class="copyRights eight columns">
					<p>copyrightÂ© 2012, cleansport.com</p>
				</div><!-- copyrights -->
			</div>
		</div><!-- footer bottom -->
	</section><!-- end of footer section -->



	<!-- JS
	================================================== -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="javascripts/jquery.waitforimages.js"></script>
	<script src="javascripts/jquery.cycle2.min.js"></script>
	<script src="javascripts/jquery.cycle2.tile.min.js"></script>
	<script src="javascripts/jcarousellite_1.0.1.min.js"></script>
	<script src="javascripts/jquery.tweet.js"></script>
	

	<script src="javascripts/main_func.js"></script>
	<script src="javascripts/home_func.js"></script>

<!-- End Document
================================================== -->
<?php //echo $this->element('sql_dump'); ?>
</body>
</html>    