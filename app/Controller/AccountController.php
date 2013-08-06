<?php

/**
 * CakePHP AccountController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class AccountController extends AppController {

    public $uses = array('Account', 'RoleUser', 'Country');
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
    
    public function index(){
        $account = $this->find('first',array(
           'conditions' => array(
               'Account.id' => $this->Auth->user('id')
           ) 
        ));
        
        $this->set(compact('account'));
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
	    $this->Account->set($this->data);
	    if ($this->Account->accountValidate()) {
		if ($this->Account->save($this->request->data)) {
		    // We need to store the site relation to the user we just generated
		    $userid = $this->Account->getLastInsertID();
		    $this->loadModel('RoleUser');
		    $this->RoleUser->addUserSite($userid);

		    $this->Session->setFlash('The user has been saved');
		    $this->redirect(array('controller' => 'home', 'action' => 'index'));
		} else {
		    $this->Session->setFlash('The user could not be saved. Please, try again.');
		}
	    }
	}
	$this->set('countries', $this->Country->getCountries());
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
		'table' => '(SELECT DISTINCT(user_id),site_id FROM roles_users )',
		'alias' => 'RolesUser',
		'type' => 'INNER',
		'conditions' => array(
		    'Account.id = RolesUser.user_id',
		    'RolesUser.site_id = ' . Configure::read('Settings.site_id')
		)
	    )
	);
	$this->paginate = array(
	    'joins' => $joins
	);
	$users = $this->paginate('Account');

	$this->set('title_for_layout', 'Accounts');
	$this->set(compact('users'));
    }

    public function admin_view($id) {
	$user = $this->Account->find('first', array(
	    'conditions' => array(
		'Account.id' => $id,
	    ),
	    'joins' => array(
		array(
		    'table' => '(SELECT DISTINCT(user_id),site_id FROM roles_users )',
		    'alias' => 'RolesUser',
		    'type' => 'INNER',
		    'conditions' => array(
			'Account.id = RolesUser.user_id',
			'RolesUser.site_id = ' . Configure::read('Settings.site_id')
		    )
	    ))));
	
	if(count($user)>0){
	    $this->set(compact('user'));
	}
    }

}
