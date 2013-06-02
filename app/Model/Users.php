<?php
/**
 * CakePHP Users
 * @author Eric
 */
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class Users extends AppModel {
    public $primaryKey = 'id';
    
    public function beforeSave($options = array()) {
    if (isset($this->data[$this->alias]['password'])) {
        $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
    }
    return true;
}
}

