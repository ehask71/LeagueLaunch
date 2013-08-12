<div class="grid_12" id="body-content"> 
    <div>
        <h2><?=__('Your Account');?></h2>
        
        <pre>
            <?php //print_r($account);?>
        </pre>
        <table width="100%">
            <tr>
                <td colspan="2">
                    <?
                        if(isset($account['Account']['image']) && !empty($account['Account']['image'])){
                            ?>
                        <img src="<?=$account['Account']['image']?>" />
                    <?
                        }else{
                            ?>
                            <img src="../images/profile.jpg" />
                            <?
                        }
                    ?>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="grid_4" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>   