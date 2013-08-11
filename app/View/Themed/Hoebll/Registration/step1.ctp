<div class="grid_12" id="body-content">
    <div> 
        <?php echo '<h2>' . __('Step 1: Players') . '</h2>'; ?>
        <?php
        if (count($prepared_data) > 0):
            // We Have Players && Registration 
            echo '<p>' . __('Select the Registration Option for each player. If a Player is not being registered leave them with "Please Select An Option"') . '</p>';
            echo $this->Form->create(FALSE, array('type' => 'file', 'action' => 'step1'));
            foreach ($prepared_data as $key => $value) {
                echo $this->Form->input('Players.' . $value['Players']['player_id'], array('label' => $value['Players']['firstname'] . ' ' . $value['Players']['lastname'], 'type' => 'select', 'class' => 'chzn-select', 'options' => $value['Players']['registration_options']));
            }
            echo $this->Form->end('Proceed To Next Step');

        else:
            /* if (!$registration_options) {
              // No Active Registrations
              ?>
              <div class="article">
              <p>We're Sorry it appears there are not any Registrations open at this time. Please check back soon.</p>
              </div>
              <?php
              } */
            if (count($prepared_data) == 0) {
                // No players
                ?>
                <div id="ajaxPlayers"></div>
                <div id="ajaxControl" style="display: none;">
                    <div class="submit">
                        <input type="submit" value="<?php echo __('Im Done Adding Players'); ?>" onclick="window.location='/registration/step1';"/>
                    </div>
                </div>
                <div class="article">
                    <p>Ok it appears you do not have any Player Profiles set up for this site. We need to add at least one so we can proceed,use the form below to add all or your players.Once you have successfully added your players. Please click the button that will appear above this text to proceed</p>
                    <p>Please be very careful with the <b>Birth Date</b>. If you don't enter correctly this system uses Birth Date to show what leagues the player can join.</p>
                </div>
                <?php
                $this->Html->scriptStart(array('block' => 'scriptBottom'));
                echo '$(document).ready(function () {
            $("#playerForm").bind("submit", function (event) {
                $.ajax({
                    async:true,  
                    data:$("#playerForm").serialize(), 
                    //dataType:"html", 
                    success:function (data, textStatus) {
                        console.log(textStatus);
                        var x = jQuery.parseJSON( data );
                        if(x.success == 1){
                            $("#ajaxPlayers").append(x.content);
                            $("#ajaxControl").css("display","block");
                            $("#playerForm").each (function(){this.reset();});
                        } else {
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                            $("#newplayerErrorDialog").html(x.content);
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
                        }
                    },
                    type:"POST", 
                    url:"\/registration\/saveplayer"});
                    return false;
                });
            });';
                $this->Html->scriptEnd();
                echo $this->Js->writeBuffer();
                echo $this->Form->create('Players', array('controller' => 'registration', 'action' => 'saveplayer', 'id' => 'playerForm', 'default' => false));
                echo $this->Form->input('firstname');
                echo $this->Form->input('lastname');
                echo $this->Form->input('nickname');
                echo $this->Form->input('birthday', array('label' => 'Player\'s Birdate', 'id' => 'birthday', 'maxYear' => 2010, 'minYear' => 1990));
                echo $this->Form->input('gender', array('type' => 'select', 'options' => array('m' => 'Male', 'f' => 'Female'), 'class' => 'chzn-select'));
                echo $this->Form->input('site_id', array('type' => 'hidden', 'value' => Configure::read('Settings.site_id')));
                echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $userinfo['id']));
                echo $this->Form->input('active', array('type' => 'hidden', 'value' => 1));
                echo $this->Form->end(__('Submit'));
            }
        endif;
        ?>
    </div>
    <div id="newplayerErrorDialog" title="<?php echo __('Error'); ?>" style="display: none;"></div>
</div>
<div class="grid_4" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>