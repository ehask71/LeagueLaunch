<div class="grid_12" id="body-content">
    <!--<div>
        <?php echo $this->Html->image('/img/baseball/playball_banner.jpg'); ?>
    </div>-->
    <h2>Success</h2>
    <div style="margin:5px,10px,5px,10px;">
        <p><?= $shop['Order']['first_name']; ?>,<br><br>&nbsp;&nbsp;Now that wasn't so bad was it? We have sent you a receipt via Email 
            please make sure you check your spam You will still need to fill out the registration forms for each of your players. They 
            will be in your Profile area here <a href="/account">Your Account</a>. If your league requires you to provide Proof of 
            Residence or a waiver make sure you have those documents. If you used "Pay At The Field" you will need to pay before your 
            Player(s) will be eligible. If you used PayPal it can take some time before we get the notification of Payment. Once we get 
            this it will automatically update and activate your players. 
        </p>
    </div>
</div>
<div class="grid_4" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>
