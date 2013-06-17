<?php

App::uses('AppModel', 'Model');

class Divisions extends AppModel {

    public $primaryKey = 'division_id';

    public function divisionValidate() {
	$validate1 = array(
	    'leaguename' => array(
		'mustNotEmpty' => array(
		    'rule' => 'notEmpty',
		    'message' => 'Please enter the League\'s Name')
	    ),
	);
	
	$this->validate = $validate1;
        return $this->validates();
    }

}

