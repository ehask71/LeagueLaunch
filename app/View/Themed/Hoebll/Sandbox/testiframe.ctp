<div class="grid_12" id="body-content">

    <!--<div class="article">
        <h2>Testing Youtube Helper Class</h2>
    <?php //echo $this->Youtube->video('http://www.youtube.com/watch?v=bmZ9xRO7M9M',array('autohide'=>true));?>
    </div>-->
    <script type="text/javascript">
        //$("#newplayerErrorDialog").html(x.content);
        $( document ).ready(function() { 
           /* $("#newplayerErrorDialog").dialog({
                modal: true,
                width: "auto"
            });*/
            
            $('#newplayerErrorDialog').bPopup();
        
        });
        window.closeDialog = function(message){
            $("#newplayerErrorDialog").dialog("close");
        }
    </script>
</div>
<div class="grid_4" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>
<div id="newplayerErrorDialog" title="<?php echo __('Error'); ?>" style="display: none;background-color: #fff;">
    <iframe src="https://leaguelaunch.com/checkout/testiframe" name="ll-payment" width="600px" height="600px"></iframe> 
</div>