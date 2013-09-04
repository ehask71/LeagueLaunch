<div class="grid_12" id="body-content"> 
    <div>
        <h2><?php echo __('View Order'); ?></h2>
        <table width="100%">
            <thead>
            <th colspan="2">Details</th>
            </thead>
            <tbody>
                <tr>
                    <td>Date:</td>
                    <td><?php echo $order['Order']['created']; ?></td>
                </tr>
                <tr>
                    <td>Id:</td>
                    <td><?php echo $order['Order']['id']; ?></td>
                </tr>
                <tr>
                    <td>Total:</td>
                    <td>$<?php echo $order['Order']['total']; ?></td>
                </tr>
                <tr>
                    <td>Payment:</td>
                    <td>
                        <?php
                        switch ($order['Order']['order_type']) {
                            case "payatfield":
                                echo "Pay At Field";
                                break;
                            case "paypal":
                                echo "PayPal";
                                break;
                            case "authnet":
                                echo "Credit Card";
                                break;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td><?php echo ($order['Order']['status'] == 2) ? Paid : 'Pending'; ?></td>
                </tr>
                <?php
                if ($order['Order']['status'] != 2):
                    ?>
                    <tr>
                        <td colspan="2">
                            <?php
                            echo "Pay: ";
                            if (Configure::read('Settings.authorize_net_enabled') == 'true') {
                                echo '<a href="https://leaguelaunch.com/checkout/ll/' . $order['Order']['id'] . '-' . $order['Order']['site_id'] . '-' . $rtn . '">Credit Card</a> ';
                            }
                            if (Configure::read('Settings.paypal_enabled') == 'true') {
                                echo $this->Form->postLink('PayPal', array('action' => 'vieworder', $order['Order']['id']), array('class' => 'button green small'));
                            }
                            /* if(Configure::read('Settings.pay_at_field') == 'true'){
                              echo $this->Form->postLink('At Field',array('action' => 'vieworder', $order['Order']['id']),
                              array('class'=>'button green small'));
                              } */
                            ?>
                        </td>
                    </tr>
                    <?php
                endif;
                ?>
            </tbody>
        </table>
        <h2><?php echo __('Order Items'); ?></h2>
        <table>
            <thead>
                <tr>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="grid_4" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div> 