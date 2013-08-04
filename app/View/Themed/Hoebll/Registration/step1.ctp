<div class="grid_12" id="body-content">
    <?php
    if (count($players) > 0 && is_array($registration_options)):
        // We Have Players && Registration 
        echo '<div>';
        echo '<h2>' . __('Step 1: Players') . '</h2>';
        echo '<p>' . __('Select the Registration Option for each player. If a Player is not being registered leave them with "Please Select An Option"') . '</p>';
        echo $this->Form->create(FALSE, array('type' => 'file', 'action' => 'step1'));
        foreach ($players as $key => $value) {
            echo $this->Form->input('Players.' . $value['Players']['player_id'], array('label' => $value['Players']['firstname'] . ' ' . $value['Players']['lastname'], 'type' => 'select', 'class' => 'chzn-select', 'options' => $registration_options));
        }
        echo $this->Form->end('Proceed To Next Step');
        echo "</div>";
    else:
        if (!$registration_options) {
            // No Active Registrations
            ?>
            <div class="article">
                <p>We're Sorry it appears there are not any Registrations open at this time. Please check back soon.</p>
            </div>
            <?php
        }
        if (count($players) == 0) {
            // No players
            ?>
            <div id="ajaxPlayers"></div>
            <div class="article">
                <p>Ok it appears you do not have any Player Profiles set up for this site. We need to add at least one so we can proceed.</p>
            </div>
            <?php
            $data = $this->Js->get('#playerForm')->serializeForm(array('isForm' => true, 'inline' => true));
            $this->Js->get('#playerForm')->event(
                    'submit', $this->Js->request(
                            array('controller' => 'registration', 'action' => 'saveplayer'), array(
                        'update' => '#ajaxPlayers',
                        'data' => $data,
                        'async' => true,
                        'dataExpression' => true,
                        'method' => 'POST',
                        'complete' => '$("#playerForm").each (function(){this.reset();});'
                            )
                    )
            );
            $this->Html->scriptStart(array('block' => 'scriptBottom'));
            echo "$(function() {
                $( '#birthday' ).datepicker({ dateFormat: 'yy-mm-dd',changeMonth: true,changeYear: true });
            });";
            $this->Html->scriptEnd();
            echo $this->Js->writeBuffer();
            echo $this->Form->create('Players', array('controller' => 'registration', 'action' => 'saveplayer', 'id' => 'playerForm', 'default' => false));
            echo $this->Form->input('firstname');
            echo $this->Form->input('lastname');
            echo $this->Form->input('nickname');
            echo $this->Form->input('birthday', array('id' => 'birthday', 'type' => 'text'));
            echo $this->Form->input('site_id', array('type' => 'hidden', 'value' => Configure::read('Settings.site_id')));
            echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $userinfo['id']));
            echo $this->Form->input('active', array('type' => 'hidden', 'value' => 1));
            echo $this->Form->end(__('Submit'));
        }
    endif;
    ?>
</div>
<div class="grid_5" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>