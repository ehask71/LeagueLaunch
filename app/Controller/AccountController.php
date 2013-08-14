<?php

/**
 * CakePHP AccountController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class AccountController extends AppController {

    public $uses = array('Account', 'RoleUser', 'Country', 'Order');
    public $components = array('Email');

    public function beforeFilter() {
	parent::beforeFilter();
	$this->Auth->allow('login', 'logout', 'register', 'forgetpwd', 'resetcode');
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

    public function index() {
	$account = $this->Account->find('first', array(
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
	    $account = $this->Account->find('first', array(
		'conditions' => array(
		    'Account.email' => $this->request->data['Account']['email']
		)
		    ));
	    if (count($account) > 0) {
		$data['id'] = $account['Account']['id'];
		$data['reset_code'] = md5($this->request->data['Account']['email'] . date('Y-m-d h:i:s'));

		if ($this->Account->save($data)) {
		    App::uses('CakeEmail', 'Network/Email');
		    $email = new CakeEmail();
		    $email->from(array('do-not-reply@leaguelaunch.com' => Configure::read('Settings.leaguename')))
			    ->sender(Configure::read('Settings.admin_email'))
			    ->replyTo(Configure::read('Settings.admin_email'))
			    ->cc(Configure::read('Settings.admin_email'))
			    ->to($account['Account']['email'])
			    ->subject(Configure::read('Settings.leaguename') . ' Password Reset')
			    ->template('forgot_passwd')
			    ->theme(Configure::read('Settings.theme'))
			    ->emailFormat('text')
			    ->viewVars(array('account' => $account, 'code' => $data['reset_code']))
			    ->send();
		}
	    }
	}
    }

    public function resetcode() {
	$this->autoRender = false;
	$account = array();
	// From Form
	if ($this->request->is('post')) {
	    if ($this->request->data['Account']['code'] != '' && strlen($this->request->data['Account']['code']) == 32) {
		$account = $this->Account->find('first', array(
		    'conditions' => array(
			'Account.reset_code' => $this->request->data['code']
		    )
			));
	    }
	    if(isset($this->request->data['Account']['password']) && isset($this->request->data['Account']['confirm_password']) && isset($this->request->data['Account']['rstcode'])){
		// We are restting the passwd
		if($this->request->data['password'] == $this->request->data['Account']['confirm_password'] && $this->request->data['Account']['password'] != ''){
		    $account = $this->Account->find('first', array(
		    'conditions' => array(
			'Account.reset_code' => $this->request->data['rstcode']
		    )
			));
		    
		    $data['id'] = $account['Account']['id'];
		    $data['password'] = $this->request->data['Account']['password'];
		    
		    if($this->Account->save($data)){
			App::uses('CakeEmail', 'Network/Email');
			$email = new CakeEmail();
			$email->from(array('do-not-reply@leaguelaunch.com' => Configure::read('Settings.leaguename')))
			    ->sender(Configure::read('Settings.admin_email'))
			    ->replyTo(Configure::read('Settings.admin_email'))
			    ->cc(Configure::read('Settings.admin_email'))
			    ->to($account['Account']['email'])
			    ->subject(Configure::read('Settings.leaguename') . ' Password Changed')
			    ->template('passwd_changed')
			    ->theme(Configure::read('Settings.theme'))
			    ->emailFormat('text')
			    ->viewVars(array('account' => $account))
			    ->send();
			
			$this->Session->setFlash(__('Password Changed!'),'alerts/success');
			$this->redirect('/login');
		    }
		    
		} else {
		    $this->Session->setFlash('Passwords Do Not Match or Blank', 'alerts/error');
		    $this->redirect('/account/resetcode/?code='.$this->request->data['Account']['rstcode']);
		}
	    }
	}
	// From Email Link
	if ($this->request->query['code'] != '' && strlen($this->request->query['code']) == 32) {
	    $account = $this->Account->find('first', array(
		'conditions' => array(
		    'Account.reset_code' => $this->request->query['code']
		)
		    ));
	}
	
	if(count($account)>0){
	    $this->set('code',$account['Account']['reset_code']);
	    $this->render('new_password');
	} else {
	    $this->render('entercode');
	}
    }

    public function logout() {
	$this->redirect($this->Auth->logout());
    }

    public function history() {
	
    }

    public function orders() {
	$this->loadModel('Order');
	$orders = $this->Order->find('all', array(
	    'conditions' => array(
		'Order.user_id' => $this->Auth->user('id'),
		'Order.site_id' => Configure::read('Settings.site_id')
	    )
		));

	$this->set(compact('orders'));
    }

    public function vieworder($id) {
	$order = $this->Order->find('first', array(
	    'conditions' => array(
		'Order.id' => $id,
		'Order.user_id' => $this->Auth->user('id'),
		'Order.site_id' => Configure::read('Settings.site_id')
	    )
		));
	$this->set('rtn', base64_encode('http://eastbaylittleleague.com/account/vieworder/' . $id));
	$this->set(compact('order'));
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

	if (count($user) > 0) {
	    $this->set(compact('user'));
	}
    }

}
