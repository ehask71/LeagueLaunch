<?php
/**
 * CakePHP RoleUser
 * @author Eric
 */
App::uses('AppModel', 'Model');

class RoleUser extends AppModel {
    
    public $primaryKey = 'id';
    
    public $useTable = 'roles_users';
    
    public $defaultRoleId = 6;
    
    public function addUserSite($userid,$roleid=0){
	$data = array('RoleUser'=> array(
	   'site_id' => Configure::read('Settings.site_id'),
	    'user_id' => (int)$userid,
	    'role_id' => ($roleid != 0)?$roleid:$this->defaultRoleId
	));
	if($this->save($data)){
	    return true;
	}
	return false;
    }

}

