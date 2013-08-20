<div class="grid_12" id="body-content"> 
    <div>
        <h2><?=__('Your Account');?></h2>
        
        <pre>
            <?php //print_r($account);?>
        </pre>
        <table width="100%" id="account-table">
            <tr>
                <td rowspan="8" class="account-image">
                    <span id="account-image">
                    <?
                        if(isset($account['Account']['image']) && !empty($account['Account']['image'])){
                            ?>
                        <img src="<?=$account['Account']['image']?>" />
                    <?
                        }else{
                            echo $this->Html->image('/common/images/profile.jpg');
                            
                        }
                    ?>
                    </span>
                </td>
                <td>Name:</td>
                <td>
                    <span class="edit" id="account-firstname"><?=$account['Account']['firstname']?></span>
                    <span class="edit" id="account-lastname"><?=$account['Account']['lastname']?></span>
                </td>
            </tr>
            <tr>
                <td>User Name:</td>
                <td>
                    <span class="edit" id="account-username"><?=$account['Account']['username']?></span>
                </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>
                    <span class="edit" id="account-email"><?=$account['Account']['email']?></span>
                </td>
            </tr>
            <tr>
                <td>
                    Street Address
                </td>
                <td>
                    <span class="edit" id="account-address"><?=$account['Account']['address']?></span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <span class="edit" id="account-address2"><?=$account['Account']['address2']?></span>
                </td>
            </tr>
            <tr>
                <td>City:</td>
                <td>
                    <span class="edit" id="account-city"><?=$account['Account']['city']?></span>
                </td>
            </tr>
            <tr>
                <td>State:</td>
                <td>
                    <span class="edit" id="account-state"><?=$account['Account']['state']?></span>
                </td>
            </tr>
            <tr>
                <td>
                    Zip Code:
                </td>
                <td>
                    <span class="edit" id="account-zip"><?=$account['Account']['zip']?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <!-- for account related actions -->
                    <a href="/account/orders">View Orders</a> | <a href="/account/history">Account History</a>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <h2>Your Players</h2>
                </td>
            </tr>
            <?
                foreach($account['Players'] as $player){
            ?>
            <tr>
                <td class="account-image">
                    <span id="account-player-image-<?=$player['player_id']?>">
                    <?
                        if(isset($player['image']) && !empty($player['image'])){
                            ?>
                        <img src="<?=$player['image']?>" />
                    <?
                        }else{
                            echo $this->Html->image('/common/images/profile.jpg');
                        }
                    ?>
                    </span>
                    <span class="edit" id="account-player-nickname-<?=$player['player_id']?>"><?=$player['nickname']?></span>
                </td>
                <td>
                    <span class="edit" id="account-player-firstname-<?=$player['player_id']?>"><?=$player['firstname']?></span>
                    <span class="edit" id="account-player-lastname-<?=$player['player_id']?>"><?=$player['lastname']?></span>
                </td>
                <td>
                    <span class="edit" id="account-player-birthday-<?=$player['player_id']?>"><?=$player['birthday']?></span>
                </td>
            </tr>
            <tr>
                <td colspan="100">
                    <!-- Player related actions -->
                    <a href="/account/forms" title="Fill out League Required forms">File Forms</a> | <a href="/account/editplayer/<?php echo $player['player_id'];?>" title="Edit this player">Edit</a>
                    <a href="/account/deleteplayer" title="Delete this player">Delete</a>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('.edit').editable('/ajax.php', { 
            submitdata : {'account_id':<?=$account['Account']['id']?>,'site_id' : <?=$account['Account']['site_id']?> }
        });
    });
</script>