<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * CakePHP Raffleticket
 * @author EricMain
 */
App::uses('Model', 'Model');

class RaffleticketModel extends Model {

    public $name = 'Raffleticket';
    public $primaryKey = 'id';

    public function validateBuyraffle() {
        $validate1 = array(
            'firstname' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter your First Name')
            ),
            'lastname' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter your Last Name')
            ),
            'address' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Enter your Address')
            ),
            'city' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Enter your City')
            ),
            'state' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Enter your State')
            ),
            'zip' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Enter your Zip/Postal Code')
            ),
            'phone' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter Your Contact Number'
                )
            ),
            'email' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Enter Your Email'
                ),
                'validEmailRule' => array(
                    'rule' => 'email',
                    'message' => 'Invalid email address'
                )
            ),
            'product_id' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Select A Product'
                )
            )
        );
        
        $this->validate = $validate1;
	return $this->validates();
    }

}
