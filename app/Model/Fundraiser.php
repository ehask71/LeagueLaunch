<?php

/**
 * CakePHP Fundraiser
 * @author Eric
 */
App::uses('AppModel', 'Model');

class Fundraiser extends AppModel {

    public $primaryKey = 'id';

    public function validateFundraiser() {
        $validate1 = array(
            'name' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter a Name')
            ),
            'description' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter a Description')
            ),
            'type' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please select the type')
            ),
            'start' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter a Start Date')
            ),
            'end' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter an End Date')
            ),
            'event_date' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please the Event Date')
            ),
            'event_location' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the Event location')
            ),
            'provider' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please select a Provider')
            ),
            'create_product' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Select if you need a product Created')
            )
        );

	$this->validate = $validate1;
	return $this->validates();
    }

}

