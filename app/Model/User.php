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
	    'unique' => 'keepExisting',
	)
    );

    public function beforeSave($options = array()) {
	if (isset($this->data[$this->alias]['password'])) {
	    $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
	}
	return true;
    }

    /*public function beforeFind(array $query) {
	$query['joins'] = array(
	    array(
		'table' => 'roles_users',
		'alias' => 'RolesUser',
		'type' => 'INNER',
		'conditions' =>
		array('User.id=RolesUser.user_id')),
	    array(
		'table' => 'roles',
		'alias' => 'Role',
		'type' => 'INNER',
		'conditions' =>
		array('RolesUser.role_id=Role.id')));
        //print_r($query);
	return $query;
    }*/

}

