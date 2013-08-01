<div class="grid_12" id="body-content">
    <?php
    if (count($players['Players']) > 0 && is_array($registration_options)):
        // We Have Players && Registration 
        echo $this->Form->create(FALSE, array('type' => 'file', 'action' => '/registration/step2'));
        foreach ($players['Players'] as $key => $value) {
            echo $this->Form->input($value, array('label' => $value['firstname'] . ' ' . $value['lastname'], 'type' => 'select', 'class' => 'chzn-select', 'options' => $registration_options));
        }
        echo $this->Form->end('Proceed To Next Step');
    else:
        if (!$registration_options) {
            // No Active Registrations
            ?>
            <div class="article">
                <p>We're Sorry it appears there are not any Registrations open at this time. Please check back soon.</p>
            </div>
            <?php
        }
        if (count($players['Players']) > 0) {
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
                            array('action' => 'save'), array(
                        'update' => '#ajaxPlayers',
                        'data' => $data,
                        'async' => true,
                        'dataExpression' => true,
                        'method' => 'POST'
                            )
                    )
            );
            echo $this->Form->create('Players', array('action' => 'save', 'id' => 'playerForm', 'default' => false));
            echo $this->Form->input('firstname');
            echo $this->Form->input('lastname');
            echo $this->Form->input('nickname');
            echo $this->Form->input('birthday', array('id' => 'birthday'));
            echo $this->Form->input('site_id', array('type'=>'hidden','value'=> Configure::read('Settings.site_id')));
            echo $this->Form->input('user_id', array('type'=>'hidden','value'=> $userinfo['id']));
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