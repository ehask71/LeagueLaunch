<?php

/**
 * CakePHP Order
 * @author Eric
 */
App::uses('AppModel', 'Model');

class Order extends AppModel {

    public $validate = array(
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Name is invalid',
            //'allowEmpty' => false,
            //'required' => true,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Email is invalid',
            //'allowEmpty' => false,
            //'required' => true,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'phone' => array(
            'notempty' => array(
                'rule' => array('phone'),
                'message' => 'Phone is invalid',
            //'allowEmpty' => false,
            //'required' => true,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'billing_address' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Billing Address is invalid',
            //'allowEmpty' => false,
            //'required' => true,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'billing_city' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Billing City is invalid',
            //'allowEmpty' => false,
            //'required' => true,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'billing_state' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Billing State is invalid',
            //'allowEmpty' => false,
            //'required' => true,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'shipping_address' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Shipping Address is invalid',
            //'allowEmpty' => false,
            //'required' => true,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'shipping_city' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Shipping City is invalid',
            //'allowEmpty' => false,
            //'required' => true,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'shipping_state' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Shipping State is invalid',
            //'allowEmpty' => false,
            //'required' => true,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'creditcard_number' => array(
            'notempty' => array(
                'rule' => array('cc'),
                'message' => 'Credit Card Number is invalid',
            //'allowEmpty' => false,
            //'required' => true,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'creditcard_code' => array(
            'rule1' => array(
                'rule' => array('notEmpty'),
                'message' => 'Credit Card Code is required',
            //'allowEmpty' => false,
            //'required' => true,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'rule2' => array(
                'rule' => '/^[0-9]{3,4}$/i',
                'message' => 'Credit Card Code is invalid',
            //'allowEmpty' => false,
            //'required' => true,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );
    public $hasMany = array(
        'OrderItem' => array(
            'className' => 'OrderItem',
            'foreignKey' => 'order_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => '',
        )
    );

    public function updateOrderStatus($order_id, $status) {
        /*
         * 1 - Pending
         * 2 - Paid Complete
         * 3 - Declined
         */
        $data = array('id' => $order_id, 'status' => $status);

        $this->save($data);
    }

    public function getAcceptedPayment() {
        $opts = array();
        if (Configure::read('Settings.paypal_enabled') == 'true') {
            $opts['paypal'] = 'PayPal';
        }
        if (Configure::read('Settings.pay_at_field') == 'true') {
            $opts['payatfield'] = 'Pay At The Field';
        }
        if (Configure::read('Settings.authorize_net_enabled') == 'true') {
            $opts['authnet'] = 'Credit Card';
        }

        return $opts;
    }

    public function validateTerminal() {
        $validate1 = array(
            'creditcard_amount' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the Amount')
            ),
            'creditcard_number' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the Credit Card number')
            ),
            'creditcard_month' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the Credit Card number')
            ),
            'creditcard_year' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the Credit Card number')
            ),
            'creditcard_code' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the Credit Card number')
            ),
            'cardholder_firstname' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the Firstname')
            ),
            'cardholder_lastname' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the Lastname')
            ),
            'cardholder_address' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the Address')
            ),
            'cardholder_city' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the City')
            ),
            'cardholder_state' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the State')
            ),
            'cardholder_zip' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the Zip')
            ),
            'cardholder_phone' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the phone')
            ),
            'cardholder_email' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the email')
            ),
        );
        
        $this->validate = $validate1;
        return $this->validates();
    }

}

