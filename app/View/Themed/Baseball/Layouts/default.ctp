<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $title_for_layout; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <?php
        echo $this->Html->css('bootstrap');
        echo $this->Html->css('style');
        echo $this->Html->css('//fonts.googleapis.com/css?family=Open+Sans:400,700');
        ?>
    </head>
    <body>
        <div class="container">
            <div class="row" id="header">

            </div>
            <?php echo $this->Layout->sessionFlash(); ?>
            <div class="row" id="body-content">
                <?php echo $this->fetch('content'); ?>
            </div>
            <div class="row" id="footer">
                <? echo $this->Regions->blocks('footer'); ?>
                <div class="row" id="copyright">
                    <div class="span12 pull-right">
                        &COPY; <?php echo Configure::read('Settings.leaguename').' '.date('Y');?><br/>
                        <small>Powered by <a href="http://leaguelaunch.com" target="_blank">LeagueLaunch</a></small>
                    </div>
                </div>
            </div>
        </div>
        <?php
        echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
        echo $this->Html->script('bootstrap');
        ?>
    </body>
</html>
