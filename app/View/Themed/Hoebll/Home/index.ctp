<div class="grid_12" id="body-content">
    <?php echo $this->element('latest_news_body',array('cache'=>'+1 hour','key'=> $domain.'_latest_news_body'));?>
</div>
<div class="grid_5" id="side-bar-right">
    <?php echo $this->element('schedule_widget',array('cache'=>'+1 hour','key'=> $domain.'_schedule_widget'));?>
    <?php echo $this->element('events_widget',array('cache'=>'+1 hour','key'=> $domain.'_events_widget'));?>
    <?php echo $this->element('sponsors_widget',array('cache'=>'+1 hour','key'=> $domain.'_sponsors_widget'));?>
</div>