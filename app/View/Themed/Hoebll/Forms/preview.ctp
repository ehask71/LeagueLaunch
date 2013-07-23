<?php
    $this->Html->scriptStart(array('block' => 'scriptBottom'));
    echo "$(function(){
    /**
     * Load captcha
     */
    $('#surveyCaptcha').load('".$this->Html->url('/survey/surveys/captcha?')."'+Math.random(), function(){
        $('#survey-captcha').unbind('hover');
    });
});
var BASE_URL = '".FULL_BASE_URL.$this->base."';
";
    $this->Html->scriptEnd();
    $this->Html->script('dynamicForms',array('block' => 'scriptBottom'));
?>
<div class = "article"> 
    <?php echo $renderForm; ?>
</div>