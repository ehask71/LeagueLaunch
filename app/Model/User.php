<?php

/**
 * CakePHP Users
 * @author Eric
 */
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

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
	)
    );

    function __construct($id = false, $table = null, $ds = null) {
	$this->hasAndBelongsToMany['Role']['conditions'] = array('RolesUser.site_id' => Configure::read('Settings.site_id'));
	parent::__construct($id, $table, $ds);
    }

    public function beforeSave($options = array()) {
	if (isset($this->data[$this->alias]['password'])) {
	    $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
	}
	return true;
    }

    public function beforeFind(array $query) {
/* $query['joins'] = array(
	  array(
	  'table' => 'roles_users',
	  'alias' => 'RolesUser',
	  'type' => 'INNER',
	  'conditions' =>
	  array('User.id=RolesUser.user_id',
	  'RolesUser.site_id='.$query['conditions']['RolesUser.site_id'])),
	  array(
	  'table' => 'roles',
	  'alias' => 'Role',
	  'type' => 'INNER',
	  'conditions' =>
	  array('RolesUser.role_id=Role.id')));
	  // Custom SaaS app mod
	  if(isset($query['conditions']['RolesUser.site_id'])){
	  //$query['joins'][0]['conditions'][] = "RolesUser.site_id={$query['conditions']['RolesUser.site_id']}";
	  unset($query['conditions']['RolesUser.site_id']);
	  }
 * 
 */
	//echo "<pre>";
	//print_r($query);
	return $query;
    }

    public function getAssociatedUsers() {
	
    }

    public function userValidate() {
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
	if (strcmp($this->data['User']['password'], $this->data['User']['confirm_password']) == 0) {
	    return true;
	}
	return false;
    }

}

