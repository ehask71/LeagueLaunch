<div class="grid_12" id="body-content">
    <div class="article">
        <h2>Online Registration</h2>
        <?php 
        if($_SERVER['REMOTE_ADDR'] != '108.9.106.233'){
            
            echo '<h2>Sorry Undergoing Maintenance Check Back Soon</h2>';
        } else {
            
    if (!$loggedIn) {
        ?>
            <p>
                To start the registration process for your child you as a parent need to have an Account and be logged in. If you already have an account please login <?php echo $this->Html->link(__('Click to Login'), '/login'); ?>
                <br><br>If you don't please create your account here <?php echo $this->Html->link(__('Click to Register'), array('controller' => 'account', 'action' => 'register')); ?>.   
            </p>
        <?php
    } else {
        ?>
            <p>
                Hello <?php echo $userinfo['firstname']; ?>,<br/>

                Welcome to <?php echo Configure::read('Settings.leaguename'); ?> Online Registration. We will guide you thru the process of registering you or your family member(s) for our League. On the next page you will see the players you have associated 
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
                        <td><b>
                            <?php
                            echo '<form action="/registration/index" name="post_'.$i.'" id="post_'.$i.'" method="POST">';
                            echo '<input type="hidden" name="data[Season][id]" value="'.$reg['Season']['id'].'"/>';
                            echo '</form>';
                            echo '<a href="#" class="registrationPostLink" onclick="document.post_'.$i.'.submit(); event.returnValue = false; return false;">'.__($reg['Season']['name']).'</a>';
                            $i++;
                            ?>
                        </b></td>
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
        }
    ?>
    </div>
    <div class="article">
        <h2>Registration Video Tutorial</h2>
        <?php echo $this->Youtube->video('http://www.youtube.com/watch?v=eLwajtqwYhg',array('autohide'=>true));?>
    </div>
</div>
<div class="grid_4" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>