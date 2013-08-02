<?php

/**
 * CakePHP Registration
 * @author Eric
 */
App::uses('AppModel', 'Model');

class Registration extends AppModel {

    public $primaryKey = 'id';

    public function validateRegistration() {
        $validate1 = array(
            'name' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter a Name')
            ),
            'startdate' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter a Start Date')
            ),
            'enddate' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter a End Date')
            )
        );

        $this->validate = $validate1;
        return $this->validates();
    }

}

