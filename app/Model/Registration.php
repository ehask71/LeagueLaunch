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
    
    public function getRegistrations(){
        return $this->find('all',array(
            'conditions'=>array(
                'Registration.site_id' => Configure::read('Settings.site_id'),
                'Registration.active' => 1,
                'and' => array(
                    array('Registration.startdate <= ' => date('Y-m-d'),'Registration.enddate >= ' => date('Y-m-d'))
                )
        )));
    }

}

