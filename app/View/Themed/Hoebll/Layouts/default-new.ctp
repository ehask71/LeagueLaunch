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
        <img src="http://cdn.leaguelaunch.com/theme/hoebll/images/eastbay-cal-ripken.jpg" style="margin: 0 auto;padding-top: 60px;">
        <?php echo $this->fetch('scriptBottom'); ?>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-42932858-1']);
            _gaq.push(['_setDomainName', '<?php echo $_SERVER['SERVER_NAME']; ?>']);
            _gaq.push(['_setAllowLinker', true]);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' :
                        'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();

        </script>
    </body>
</html>
