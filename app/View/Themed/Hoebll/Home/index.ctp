<div class="grid_12" id="body-content">
    <?php echo $this->element('latest_news_body',array(),array('cache'=>array('time'=>'+1 hour')));?>
    <!--<div class="article">
        <h2>Testing Youtube Helper Class</h2>
        <?php //echo $this->Youtube->video('http://www.youtube.com/watch?v=bmZ9xRO7M9M',array('autohide'=>true));?>
    </div>-->
</div>
<div class="grid_4" id="side-bar-right">
    <?php echo $this->element('schedule_widget',array(),array('cache'=>array('time'=>'+1 hour')));?>
    <?php echo $this->element('events_widget',array(),array('cache'=>array('time'=>'+1 hour')));?>
    <?php echo $this->element('sponsors_widget',array(),array('cache'=>array('time'=>'+1 hour')));?>
</div>