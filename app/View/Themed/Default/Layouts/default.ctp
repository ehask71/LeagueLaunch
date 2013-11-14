<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>LeagueLaunch - <?php echo $title_for_layout; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <?php echo $this->Html->css('bootstrap'); ?>
        <?php echo $this->Html->css('style'); ?>
        <?php
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
        <link href='http://fonts.googleapis.com/css?family=Oswald|Open+Sans:400,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div class="container">
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->Session->flash('auth'); ?>
                    <?php echo $this->fetch('content'); ?>
        </div>
        <?php echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'); ?>
        <?php echo $this->Html->script('bootstrap'); ?>
        <?php echo $this->fetch('scriptBottom'); ?>
    </body>
</html>