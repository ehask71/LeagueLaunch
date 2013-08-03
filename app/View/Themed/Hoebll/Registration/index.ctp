<div class="grid_12" id="body-content">
    <div class="article">
        <h2>Online Registration</h2>
    <?php
    if (!$loggedIn) {
        ?>
            <p>
                To start the registration process you need to have an Account and Login. Please create your account here <?php echo $this->Html->link(__('Click to Register'), array('controller' => 'account', 'action' => 'register')); ?>. If you already 
                have an account please login <?php echo $this->Html->link(__('Click to Login'), '/login'); ?>.   
            </p>
        <?php
    } else {
        ?>
            <p>
                Hello <?php echo $userinfo['firstname']; ?>,

                Welcome to <?php echo Configure::read('Settings.leaguename'); ?> Online Registration. We will guide you thru the process of registering you or your family member for our League. On the next page you will see the players you have associated 
                with your account. If you haven't set up any player profiles yet don't worry you will be able to do so from the next page.  
            </p>
            <p>
            <table>
                <thead>
                    <tr>
                        <th>Available Registrations. Please Click On One</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(count($registrations) > 0){
                        $i=1;
                        foreach ($registrations AS $reg){
                            ?>
                    <tr>
                        <td>
                            <?php
                            echo '<form action="/registration/index" name="post_'.$i.'" id="post_'.$i.'" method="POST">';
                            echo '<input type="hidden" name="data[Registration][id]" value="'.$reg['Registration']['id'].'"/>';
                            echo '<input type="hidden" name="data[Registration][season_id]" value="'.$reg['Registration']['season_id'].'"/>';
                            echo '</form>';
                            echo '<a href="#" class="registrationPostLink" onclick="document.post_'.$i.'.submit(); event.returnValue = false; return false;">'.__($reg['Registration']['name']).'</a>';
                            $i++;
                            ?>
                        </td>
                    </tr>
                            <?php
                        }
                    } else {
                        ?>
                    <tr>
                        <td colspan="1">We're Sorry There Are No Active Registrations At This Time</td>
                    </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
                <?php //echo $this->Html->link(__('Click Here to Proceed with Registration'), array('action' => 'step1')); ?>
            </p>
        <?php
    }
    ?>
    </div>
</div>
<div class="grid_5" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>