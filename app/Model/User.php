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
	    'unique' => true,
	)
    );

    public function beforeSave($options = array()) {
	if (isset($this->data[$this->alias]['password'])) {
	    $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
	}
	return true;
    }

}

