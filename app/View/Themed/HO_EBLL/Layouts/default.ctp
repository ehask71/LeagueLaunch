<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>{PAGETITLE}</title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->meta('keywords', $meta_keywords);
        echo $this->Html->meta('description', $meta_description);
        ?>
        <meta name="abstract" content="{ABSTRACT}" />
        <meta name="author" content="LeagueLaunch.com" />
        <!-- begin css -->
        <?php
        echo $this->Html->css('/common/css/reset');
        echo $this->Html->css('/common/css/960');
        echo $this->Html->css('/common/css/social');
        echo $this->Html->css('style');
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
                        <ul id="top-nav">
                            <li><a href="/login" title="Login to {SITENAME}">LOGIN</a></li>
                            <li><a href="/register" title="Sign Up with {SITENAME}">SIGNUP</a></li>
                            <li><a href="/contact" title="Contact {SITENAME}">CONTACT</a></li>
                        </ul>
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
                <div class="grid_16" id="nav-container">
                    <ul id="nav">
                        <li><a href="/index.php" title="{SITENAME} Home Page">Home</a></li>
                        <li><a href="/news.php" title="{SITENAME} News Page">News</a></li>
                        <li><a href="/calendar.php" title="{SITENAME} Calendar Page">Calendar</a></li>
                        <li><a href="/schedule.php" title="{SITENAME} Game Schedule Page">Schedule</a></li>
                        <li><a href="/standings.php" title="{SITENAME} Current Standings Page">Standings</a></li>
                        <li><a href="/staff.php" title="{SITENAME} Staff Page">Staff</a>
                            <ul class="subnav">
                                <li><a href="/staff/coaches.php" title="{SITENAME} Staff: Coaches Page">Coaches</a></li>
                                <li><a href="/staff/board.php" title="{SITENAME} Staff: Board Page">Board members</a></li>
                            </ul>
                        </li>
                        <li><a href="/sponsors.php" title="{SITENAME} Sponsors Page">Home</a></li>

                    </ul>
                </div>
            </header>
            <!-- end header -->
            <section class="grid_16">
                <div class="grid_16_nospace" id="carousel-container"></div>
                <!-- Begin Body -->
                <div class="grid_12" id="body-content" >
                    <div class="article">
                        <h2>East Bay Little League Summer Baseball &amp; Softball Camp 2013</h2>
                        <cite>posted: 06/14/2013</cite>
                        <img src="ebll/images/test-image.jpg" class="right" />
                        <p>Weekly Cost: $ 85 (9am-2pm)<br />
                            $150 (9am-5:30 Pm)<br />
                            Daily Rate $30 (9-2pm) <br />
                            <br />
                            Dates: Weeks of: June 10th -14th, 
                            June 17th-21st, June 24th-28th<br />
                            July 1st-5 (no camp), 8th-12th, 15th-
                            19th, 22nd- 26th 29th-August 2nd<br />
                            <br />
                            Counselors:<br />
                            Kennedy Duran-<br />
                            Head Baseball Coach Dr. Lennard HS, <br />
                            Former Minor Leaguer<br />
                            <br />
                            Bill Colome-<br />
                            Head baseball Coach Eastbay HS, Former Minor leaguer<br />
                            <br />
                            Christian Diaz-<br />
                            Faith Baptist Pitching Coach, Former Minor leaguer 
                        </p>
                    </div>
                    <div class="article">
                        <h2 class="attention">Attention Volunteers! Coaches and Managers!!</h2>
                        <cite>posted: 06/14/2013</cite>
                        <p>
                            <strong>Calling All Coaches</strong><br />

                            Apply Now!  Click here to complete your online Volunteer application.  Applications need to be in for all who plan on coaching or even “just helping”on the field.  If you know of anyone interested in being a coach or team manager for East Bay Little League please have them complete a volunteer application.  Thank You!
                            <p>
                                </div>
                                </div>
                                <div class="grid_5" id="side-bar-right">
                                    <div class="widget">
                                        <h2>Schedule</h2>
                                        <ul>
                                            <li>
                                                <div class="left">
                                                    02/23/2013 6:30pm<br />
                                                    Giants at Rangers
                                                </div>
                                                <div class="right">
                                                    status: F<span class="notation">*</span><br />
                                                    score: 2-12
                                                </div>
                                                <div class="clear"></div>
                                            </li>
                                            <li>
                                                <div class="left">
                                                    02/23/2013 6:30pm<br />
                                                    Giants at Rangers
                                                </div>
                                                <div class="right">
                                                    status: F<span class="notation">*</span><br />
                                                    score: 2-12
                                                </div>
                                                <div class="clear"></div>
                                            </li>
                                            <li>
                                                <div class="left">
                                                    02/23/2013 6:30pm<br />
                                                    Giants at Rangers
                                                </div>
                                                <div class="right">
                                                    status: F<span class="notation">*</span><br />
                                                    score: 2-12
                                                </div>
                                                <div class="clear"></div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="widget">
                                        <h2>Events</h2>
                                        <ul>
                                            <li>
                                                <div class="left">
                                                    06/15/2013

                                                </div>
                                                <div class="right">
                                                    Father's Day

                                                </div>
                                                <div class="clear"></div>
                                            </li>
                                            <li>
                                                <div class="left">
                                                    06/23/2013 6:30pm<br />
                                                    Town Hall
                                                </div>
                                                <div class="right">
                                                    Board Meeting
                                                </div>
                                                <div class="clear"></div>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="widget">
                                        <h2>Sponsors</h2>
                                        <ul>
                                            <li><a href="#">Sponsor ABC</a><br />
                                                Bringing Little League Dreams come true
                                            </li>
                                        </ul>
                                    </div>
                                </div>
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
                                        </div>
                                    </div>
                                    <div class="grid_4">
                                        <div class="content">
                                            <h3>Navigation</h3>
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
