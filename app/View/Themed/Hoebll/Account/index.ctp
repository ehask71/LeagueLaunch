<div class="grid_12" id="body-content"> 
    <div>
        <h2><?=__('Your Account');?></h2>
        
        <pre>
            <?php //print_r($account);?>
        </pre>
        <table width="100%">
            <tr>
                <td colspan="2" rowspan="8">
                    <?
                        if(isset($account['Account']['image']) && !empty($account['Account']['image'])){
                            ?>
                        <img src="<?=$account['Account']['image']?>" />
                    <?
                        }else{
                            ?>
                           <?=$this->Html->image('/common/images/profile.jpg')?>
                            <?
                        }
                    ?>
                </td>
                <td>
                    <span id="account-firstname"><?=$account['Account']['firstname']?></span>
                    <span id="account-lastname"><?=$account['Account']['lastname']?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <span id="account-username"><?=$account['Account']['username']?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <span id="account-email"><?=$account['Account']['email']?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <span id="account-address"><?=$account['Account']['address']?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <span id="account-address2"><?=$account['Account']['address2']?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <span id="account-city"><?=$account['Account']['city']?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <span id="account-state"><?=$account['Account']['state']?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <span id="account-zip"><?=$account['Account']['zip']?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h2>Players</h2>
                </td>
            </tr>
            <?
                foreach($account['Players'] as $player){
            ?>
            <tr>
                <td>
                    <span id="account-player-nickname-<?=$player['player_id']?>"><?=$player['nickname']?></span>
                </td>
                <td>
                    <span id="account-player-firstname-<?=$player['player_id']?>"><?=$player['firstname']?></span>
                    <span id="account-player-lastname-<?=$player['player_id']?>"><?=$player['lastname']?></span>
                </td>
                <td>
                    <span id="account-player-birthday-<?=$player['player_id']?>"><?=$player['birthday']?></span>
                </td>
            </tr>
            <?
                }
            ?>
        </table>
    </div>
</div>
<div class="grid_4" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>   