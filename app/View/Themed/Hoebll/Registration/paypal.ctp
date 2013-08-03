<html> 
    <head>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    </head>
    <body>
        <form name="confirmation" id="confirmation" method="post" action="https://www.paypal.com/cgi-bin/webscr">
            <input type="hidden" name="business" value="<?php echo Configure::read('Settings.paypal_email'); ?>">
            <input type="hidden" name="cmd" value="_xclick">
            <input type="hidden" name="rm" value="2">
            <input type="hidden" name="amount" value="<?php echo $shop['Order']['total'] ?>">
            <input type="hidden" name="return" value="<?php echo $_SERVER["SERVER_NAME"]; ?>/registration/success">
            <input type="hidden" name="cancel_return" value="<?php echo $_SERVER["SERVER_NAME"]; ?>/registration/oops">
            <input type="hidden" name="item_name" value="<?php echo Configure::read('Settings.leaguename'); ?> Online Registration">
            <input type="hidden" name="currency_code" value="USD">
            <input type="hidden" name="no_note" value="0">
            <input type="hidden" name="first_name" value="<?php echo $shop['Order']['first_name']; ?>">
            <input type="hidden" name="last_name" value="<?php echo $shop['Order']['last_name']; ?>">
            <input type="hidden" name="email" value="<?php echo $shop['Order']['email']; ?>">
            <input type="hidden" name="country" value="US">
        </form>
        
    </body>
</html>