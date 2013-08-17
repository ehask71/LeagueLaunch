<div class="grid_12" id="body-content">

    <!--<div class="article">
        <h2>Testing Youtube Helper Class</h2>
    <?php //echo $this->Youtube->video('http://www.youtube.com/watch?v=bmZ9xRO7M9M',array('autohide'=>true));?>
    </div>-->
    <script type="text/javascript">
        //$("#newplayerErrorDialog").html(x.content);
        $( document ).ready(function() { 
            $("#newplayerErrorDialog").dialog({
                modal: true,
                buttons: {
                    "OK": {
                        class: "btn btn-primary",
                        text: "OK",
                        click: function() { $(this).dialog("close"); }
                    }
                }
            });
        });
        window.closeDialog = function(message){
            alert(message);
            $("#newplayerErrorDialog").hide();
        }
    </script>
</div>
<div class="grid_4" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>
<div id="newplayerErrorDialog" title="<?php echo __('Error'); ?>" style="display: none;">
    <iframe src="https://leaguelaunch.com/checkout/testiframe"></iframe> 
</div>