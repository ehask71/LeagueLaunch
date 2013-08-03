<div class="grid_12" id="body-content">
    <h2><?php echo __('Step 3: Review'); ?></h2>
    <hr>
    <div class="row">
        <div class="col-lg-4">

            First Name: <?php echo $shop['Order']['first_name']; ?><br />
            Last Name: <?php echo $shop['Order']['last_name']; ?><br />
            Email: <?php echo $shop['Order']['email']; ?><br />
            Phone: <?php echo $shop['Order']['phone']; ?><br />

            <br />

        </div>
        <div class="col-lg-4">

            Billing Address: <?php echo $shop['Order']['billing_address']; ?><br />
            Billing Address 2: <?php echo $shop['Order']['billing_address2']; ?><br />
            Billing City: <?php echo $shop['Order']['billing_city']; ?><br />
            Billing State: <?php echo $shop['Order']['billing_state']; ?><br />
            Billing Zip: <?php echo $shop['Order']['billing_zip']; ?><br />
            Billing Country: <?php echo $shop['Order']['billing_country']; ?><br />

            <br />

        </div>
        <div class="col-lg-4">

            Shipping Address: <?php echo $shop['Order']['shipping_address']; ?><br />
            Shipping Address 2: <?php echo $shop['Order']['shipping_address2']; ?><br />
            Shipping City: <?php echo $shop['Order']['shipping_city']; ?><br />
            Shipping State: <?php echo $shop['Order']['shipping_state']; ?><br />
            Shipping Zip: <?php echo $shop['Order']['shipping_zip']; ?><br />
            Shipping Country: <?php echo $shop['Order']['shipping_country']; ?><br />

            <br />

        </div>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
            </thead>
            <?php
            if (count($shop['OrderItem']) > 0) {
                foreach ($shop['OrderItem'] AS $item) {
                    echo '<tr>';
                    echo '<td>' . $item['name'] . '</td>';
                    echo '<td>' . $item['quantity'] . '</td>';
                    echo '<td>' . $item['price'] . '</td>';
                    echo '</tr>';
                    if (count($players) > 0) {
                        foreach ($players AS $play) {
                            if ($item['product_id'] == $play['product']) {
                                echo "<tr>";
                                echo '<td colspan="3"> ---> Player: ' . $play['player'] . '</td>';
                                echo '</tr>';
                            }
                        }
                    }
                }
            }
            ?>
            <tr>
                <td colspan="2" align="right">SubTotal:</td><td>$<?php echo $shop['Order']['subtotal']; ?></td>
            </tr>
            <tr>
                <td colspan="2" align="right">Total:</td><td>$<?php echo $shop['Order']['total']; ?></td>
            </tr>
        </table>
        <?php echo $this->Form->postButton('Start Over', '/registration/clear'); ?>
    </div>

    <div>
        <?php echo $this->Form->postButton('Payment', '/registration/review'); ?>
    </div>
</div>
<div class="grid_5" id="side-bar-right">
    <?php echo $this->element('schedule_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('events_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
    <?php echo $this->element('sponsors_widget', array(), array('cache' => array('time' => '+1 hour'))); ?>
</div>