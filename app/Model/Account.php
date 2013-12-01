<?php

/**
 * CakePHP Account
 * @author Eric
 */
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class Account extends AppModel {

    public $name = 'Account';
    public $actsAs = array('Search.Searchable');
    public $primaryKey = 'id';
    public $hasAndBelongsToMany = array(
	'Role' => array(
	    'className' => 'Role',
	    'joinTable' => 'roles_users',
	    'foreignKey' => 'user_id',
	    'assosciationForeignKey' => 'role_id',
	    'unique' => 'keepExisting'
	)
    );
    public $hasMany = array(
	'RoleUser' => array(
	    'className' => 'RoleUser',
	    'foreignKey' => 'user_id',
	    'dependant' => true
	),
	'Players' => array(
	    'className' => 'Players',
	    'foreignKey' => 'user_id',
	    'dependant' => true
	)
    );
    
    public $filterArgs = array(
        'firstname' => array('type' => 'like'),
        'lastname' => array('type' => 'like'),
        'email' => array('type' => 'like'),
        //'filter' => array('type' => 'query', 'method' => 'orConditions'),
    );
    
    function __construct($id = false, $table = null, $ds = null) {
	$this->hasAndBelongsToMany['Role']['conditions'] = array('RoleUser.site_id' => Configure::read('Settings.site_id'));
	$this->hasMany['Players']['conditions'] = array('Players.site_id' => Configure::read('Settings.site_id'));
	parent::__construct($id, $table, $ds);
    }

    public function beforeSave($options = array()) {
	if (isset($this->data[$this->alias]['password'])) {
	    $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
	}
	return true;
    }

    public function beforeFind($query) {


	return $query;
    }

    public function getAssociatedUsers() {
	
    }

    public function accountValidate() {
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
	    'country' => array(
		'mustNotEmpty' => array(
		    'rule' => 'notEmpty',
		    'message' => 'Please Select Your Country'
		)
	    ),
            'phone' => array(
		'mustNotEmpty' => array(
		    'rule' => 'notEmpty',
		    'message' => 'Please enter Your Contact Number'
		)
	    ),
	    'gender' => array(
		'mustNotEmpty' => array(
		    'rule' => 'notEmpty',
		    'message' => 'Please Select Your Gender'
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
		),
		'uniqueEmailRule' => array(
		    'rule' => 'isUnique',
		    'message' => 'Email already registered'
		)
	    ),
	    'password' => array(
		'mustNotEmpty' => array(
		    'rule' => 'notEmpty',
		    'message' => 'Please Enter Your Password'
		),
		'passwordequal' => array(
		    'rule' => 'checkpasswords',
		    'message' => 'Passwords dont match'
		)
	    ),
	    'confirm_password' => array(
		'mustNotEmpty' => array(
		    'rule' => 'notEmpty',
		    'message' => 'Please Confirm Password'
		)
	    ),
	    'agever' => array(
		'notEmpty' => array(
		    'rule' => array('comparison', '!=', 0),
		    'required' => true,
		    'message' => 'We require you to be over 13 to register without a Parent.'
		)
	    ),
	    'agreeterms' => array(
		'notEmpty' => array(
		    'rule' => array('comparison', '!=', 0),
		    'required' => true,
		    'message' => 'Please Agree to the Terms if you want to proceed.'
		)
	    ),
	);

	$this->validate = $validate1;
	return $this->validates();
    }

    function checkpasswords() {
	if (strcmp($this->data['Account']['password'], $this->data['Account']['confirm_password']) == 0) {
	    return true;
	}
	return false;
    }
}
