<?php

class UsersController extends AppController {

    public $uses = array('User', 'RoleUser');
    public $components = array('Email');

    public function beforeFilter() {
	parent::beforeFilter();
	$this->Auth->allow('login', 'logout', 'register', 'forgetpwd', 'confirmpwd');
    }

    public function isAuthorized($user) {
	if ($user['role'] == 'admin') {
	    return true;
	}
	if (in_array($this->action, array('edit', 'delete'))) {
	    if ($user['id'] != $this->request->params['pass'][0]) {
		return false;
	    }
	}
	return true;
    }

    public function login() {
	if ($this->request->is('post')) {
	    if ($this->Auth->login()) {
		$this->redirect($this->Auth->redirect());
	    } else {
		$this->Session->setFlash('Your username or password was incorrect.');
	    }
	}
    }

    public function register() {
	if ($this->request->is('post')) {
	    $this->User->set($this->data);
	    if ($this->User->userValidate()) {
		if ($this->User->save($this->request->data)) {
		    // We need to store the site relation to the user we just generated
		    $userid = $this->User->getLastInsertID();
		    $this->loadModel('RoleUser');
		    $this->RoleUser->addUserSite($userid);

		    $this->Session->setFlash('The user has been saved');
		    $this->redirect(array('action' => 'index'));
		} else {
		    $this->Session->setFlash('The user could not be saved. Please, try again.');
		}
	    }
	}
    }

    public function forgetpwd() {
	if ($this->request->is('post')) {
	    
	}
    }

    public function confirmpwd() {
	
    }

    public function logout() {
	$this->redirect($this->Auth->logout());
    }

    public function admin_index() {
	$joins = array(
	    array(
		'table' => '(SELECT * FROM roles_users LIMIT 1)',
		'alias' => 'RolesUser',
		'conditions' => array(
		    'RolesUser.site_id = ' . Configure::read('Settings.site_id')
		)
	    )
	);
	$this->paginate = array(
	    'joins' => $joins
	);
	$users = $this->paginate('User');

	$this->set('title_for_layout', 'Users');
	$this->set(compact('users'));
    }

}