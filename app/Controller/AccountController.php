<?php

/**
 * CakePHP AccountController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class AccountController extends AppController {

    public $name = 'Account';
    public $uses = array('Account', 'RoleUser', 'Country', 'Order');
    public $components = array('Email', 'LeagueAge','Paginator'); //'Search.Prg',
    /*public $presetVars = array(
        array('field'=>'firstname','type' => 'value'),
        array('field'=>'lastname','type' => 'value'),
        array('field'=>'email','type' => 'value'),
    );*/
    public $presetVars = true;
    
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
			    ->config(array('host' => 'mail.leaguelaunch.com', 'port' => 25, 'username' => 'do-not-reply@leaguelaunch.com', 'password' => '87.~~?ZG}eI}', 'transport' => 'Smtp'))
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
	    $this->Session->setFlash(__('Check Your Email. If your in our system you should get an email.'), 'alerts/info');
	    $this->redirect(array('action' => 'resetcode'));
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
			'Account.reset_code' => $this->request->data['Account']['code']
		    )
			));
	    }
	    if (isset($this->request->data['Account']['password']) && isset($this->request->data['Account']['confirm_password']) && isset($this->request->data['Account']['rstcode'])) {
		// We are restting the passwd
		if ($this->request->data['Account']['password'] == $this->request->data['Account']['confirm_password'] && $this->request->data['Account']['password'] != '') {
		    $account = $this->Account->find('first', array(
			'conditions' => array(
			    'Account.reset_code' => $this->request->data['Account']['rstcode']
			)
			    ));

		    $data['id'] = $account['Account']['id'];
		    $data['password'] = $this->request->data['Account']['password'];
		    $data['reset_code'] = '';

		    if ($this->Account->save($data)) {
			App::uses('CakeEmail', 'Network/Email');
			$email = new CakeEmail();
			$email->from(array('do-not-reply@leaguelaunch.com' => Configure::read('Settings.leaguename')))
				->config(array('host' => 'mail.leaguelaunch.com', 'port' => 25, 'username' => 'do-not-reply@leaguelaunch.com', 'password' => '87.~~?ZG}eI}', 'transport' => 'Smtp'))
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

			$this->Session->setFlash(__('Password Changed!'), 'alerts/success');
			$this->redirect('/login');
		    }
		} else {
		    $this->Session->setFlash('Passwords Do Not Match or Blank', 'alerts/error');
		    $this->redirect('/account/resetcode/?code=' . $this->request->data['Account']['rstcode']);
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

	if (count($account) > 0) {
	    $this->set('code', $account['Account']['reset_code']);
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

    public function editplayer($id) {
	$this->loadModel('Players');
	if ($this->request->is('post') || $this->request->is('put')) {
	    $this->request->data['Players']['league_age'] = $this->LeagueAge->calculateLeagueAge($this->request->data['Players']['birthday']);
	    if ($this->Players->validatePlayer()) {
		if ($this->Players->save($this->request->data)) {
		    $this->Session->setFlash(__('Player Updated Successfully'), 'alerts/success');
		    $this->redirect('/account');
		}
	    } 
	}
	$player = $this->Players->find('first', array(
	    'conditions' => array(
		'Players.player_id' => $id,
		'Players.user_id' => $this->Auth->user('id'),
		'Players.site_id' => Configure::read('Settings.site_id')
	    )
		));
	if ($player) {
	    $this->request->data = $player;
	}
	$this->set('title', 'Edit Player');
	$this->render('addplayer');
    }

    public function addplayer() {
	if ($this->request->is('post')) {
	    $this->loadModel('Players');
	    $this->request->data['Players']['league_age'] = $this->LeagueAge->calculateLeagueAge($this->request->data['Players']['birthday']);
	    // Test To see if the player Exists!!
	    $playercheck = $this->Players->find('first', array(
		'conditions' => array(
		    'Players.firstname' => $this->request->data['Players']['firstname'],
		    'Players.lastname' => $this->request->data['Players']['lastname'],
		    'Players.birthday' => $this->request->data['Players']['birthday']['year'] . '-' . $this->request->data['Players']['birthday']['month'] . '-' . $this->request->data['Players']['birthday']['day'],
		    'Players.site_id' => Configure::read('Settings.site_id'),
		    'Players.user_id' => $this->Auth->user('id')
		)
		    ));
	    if ($this->Players->validatePlayer()) {
		if (count($playercheck) == 0) {
		    if ($this->Players->save($this->request->data)) {
			$this->Session->setFlash(__('Player Added Successfully'), 'alerts/success');
			$this->redirect('/account');
		    }
		} else {
		    $this->Session->setFlash(__('Player Already Exists'), 'alerts/error');
		}
	    }
	}
	$this->set('title', 'Add Player');
    }
    
    public function playerforms($id){
	$this->loadModel('Season');
	$this->loadModel('Forms');
	$forms = $this->Forms->getActiveRegistration();
	if($forms && $this->Season->checkPlayerForms($id)){
	    $this->set('forms',$forms);
	} else {
	    $this->set('forms',array());
	}
	$this->set('title_for_layout',__('Player Forms'));
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
        $this->set('users',$users);
        /*$this->Prg->commonProcess();
        $this->Paginator->settings = array(
            'conditions' => $this->Account->parseCriteria($this->Prg->parsedParams()),
            'joins' => array(
	    array(
		'table' => '(SELECT DISTINCT(user_id),site_id FROM roles_users )',
		'alias' => 'RolesUser',
		'type' => 'INNER',
		'conditions' => array(
		    'Account.id = RolesUser.user_id',
		    'RolesUser.site_id = ' . Configure::read('Settings.site_id')
		)
	    ))
        );
        $this->set('users', $this->Paginator->paginate('Account'));*/
	$this->set('title_for_layout', 'Accounts');
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
    
    public function admin_addplayer($id){
        $this->loadModel('Players');
	if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Players']['league_age'] = $this->LeagueAge->calculateLeagueAge($this->request->data['Players']['birthday']);
	    if ($this->Players->validatePlayer()) {
                if ($this->Players->save($this->request->data)) {
		    $this->Session->setFlash(__('Player Added Successfully'), 'alerts/success');
		    $this->redirect('/admin/account/view/'.$id);
		}
            }
        }
        $this->request->data['Players']['user_id'] = $id;
        $this->set('title','Add Player');
        $this->render('admin_editplayer');
    }    
    
    public function admin_editplayer($id){
	$this->loadModel('Players');
	if ($this->request->is('post') || $this->request->is('put')) {
	    $this->request->data['Players']['league_age'] = $this->LeagueAge->calculateLeagueAge($this->request->data['Players']['birthday']);
	    if ($this->Players->validatePlayer()) {
		if ($this->Players->save($this->request->data)) {
		    $this->Session->setFlash(__('Player Updated Successfully'), 'alerts/success');
		    $this->redirect('/admin/account/editplayer/'.$id);
		}
	    } 
	}
	$player = $this->Players->find('first',array(
	   'conditions' => array(
	       'Players.player_id' => $id,
	       'Players.site_id' => Configure::read('Settings.site_id')
	   ) 
	));
	
	if ($player) {
	    $this->request->data = $player;
	}
	$this->set('title', 'Edit Player');
    }
    
    public function admin_find(){
        $this->Prg->commonProcess();
        $this->Paginator->settings = array(
            'conditions' => $this->Account->parseCriteria($this->Prg->parsedParams()),
            'joins' => array(
	    array(
		'table' => '(SELECT DISTINCT(user_id),site_id FROM roles_users )',
		'alias' => 'RolesUser',
		'type' => 'INNER',
		'conditions' => array(
		    'Account.id = RolesUser.user_id',
		    'RolesUser.site_id = ' . Configure::read('Settings.site_id')
		)
	    ))
        );
        mail('ehask71@gmail.com','paginate-cond',print_r($this->Account->parseCriteria($this->Prg->parsedParams()),1));
        $this->set('users', $this->Paginator->paginate('Account'));
    }
    
    public function admin_addrole($user){
	if ($this->request->is('post') || $this->request->is('put')) {
	    $this->loadModel('RoleUser');
	    $data = array(
		'site_id' => Configure::read('Settings.site_id'),
		'user_id' => $this->request->data['user_id'],
		'role_id' => $this->request->data['role_id'],
	    );
	}
	$this->loadModel('Role');
	$roles = $this->Role->find('all',array(
	    'Role.id !=' => 1
	));
	
	$this->set('user_id',$user);
	$this->set(compact('roles'));
	$this->set('title_for_layout','Roles');
    }
    
    public function admin_deleterole($user,$role_id){
	
    }
}
