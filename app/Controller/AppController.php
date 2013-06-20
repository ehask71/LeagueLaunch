<?php

App::uses('Controller', 'Controller');
App::uses('PhpReader', 'Configure');

class AppController extends Controller {

    public $viewClass = 'Theme';
    public $theme = 'default';
    public $uses = array('Settings', 'Sites', 'Widget');
    public $components = array(
	'Session',
	'Auth' => array(
	    'loginRedirect' => array('controller' => 'home', 'action' => 'index'),
	    'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            'loginAction'    => '/login',
	)
    );

    public function beforeFilter() {
	//mail('ehask71@gmail.com','Test BF',print_r($this->here,1));
	$this->Auth->authorize = array('Tiny');

	$this->Widget->build($this->prefix, $this->params['controller'], $this->params['action']);
	//print_r($this->Auth->user());
	$this->set('userinfo', $this->Auth->user());
	$domain = $this->Sites->getDomain();
	if ($this->Sites->getSiteId($domain)) {
	    $result = $this->Sites->find('first', array(
		'conditions' => array(
		    'Sites.domain' => $domain,
		    'Sites.isactive' => 'yes')
		    ));
	    if (count($result) > 0) {
		$this->Auth->authenticate = array(
		    'Form' => array(
                        'fields' => array('username' => 'email', 'password' => 'password'), 
			'scope' => array(
			    //'RolesUser.site_id' => $result['Sites']['site_id'],
			    'User.is_active' => 'yes'
			),
			'recursive' => 1,
			//'contain' => array('RolesUser')
		    )
		);
                $this->set( 'loggedIn', $this->Auth->loggedIn() );
		$settings = $this->Settings->buildSettings($result['Sites'], $result['Settings']);
		
		// Set Theme From settings
		$this->theme = $settings['theme'];
		// Override if we are admin!
		if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {
		    $this->theme = 'admin';
		}
		// Load Theme configs
		Configure::config('themeconfig', new PhpReader(APP . 'View' . DS . 'Themed' . DS . ucfirst($this->theme) . DS));
		Configure::load($this->theme . 'conf', 'themeconfig', true);

		// Set Needed Data (meta, domain, etc)
		$this->set('meta_keywords', (@$settings['meta_keywords'] != '') ? @$settings['meta_keywords'] : 'League Launch,Sports Team management,League,Soccer,Baseball,Football,Hockey');
		$this->set('meta_description', (@$settings['meta_description'] != '') ? @$settings['meta_description'] : 'LeagueLaunch.com :: League Management Made Easy');
		$this->set('domain', $domain);
		$this->set('settings', $settings);
		$this->set('site_id', $result['Sites']['site_id']);
	    } else {
		$this->set('meta_keywords', 'League Launch,Sports Team management,League,Soccer,Baseball,Football,Hockey');
		$this->set('meta_description', 'LeagueLaunch.com :: League Management Made Easy');
		throw new NotFoundException($domain . ' Was not found or is misconfigured');
	    }
	} else {
	    $this->set('meta_keywords', 'League Launch,Sports Team management,League,Soccer,Baseball,Football,Hockey');
	    $this->set('meta_description', 'LeagueLaunch.com :: League Management Made Easy');
	    throw new NotFoundException($domain . ' Was not found or is misconfigured');
	}
    }

    public function beforeRender() {
	parent::beforeRender();
    }

}
