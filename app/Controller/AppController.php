<?php
App::uses('Controller', 'Controller');
App::uses('PhpReader', 'Configure');

class AppController extends Controller {

    public $viewClass = 'Theme';
    public $theme = 'default';
    public $uses = array('Settings', 'Sites','Widget');
    public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email')
                )
            ),
            'loginRedirect' => array('controller' => 'users', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login')
        )
    );

    public function beforeFilter() {
        $this->Auth->authorize = array('Tiny');
        //$this->Auth->authenticate = array('Form');
	$this->Widget->build($this->prefix,$this->params['controller'],$this->params['action']);
        $domain = $this->getDomain();
        if ($this->Sites->getSiteId($domain)) {
            $result = $this->Sites->find('first', array(
                'conditions' => array(
                    'Sites.domain' => $domain,
                    'Sites.isactive' => 'yes')
                    ));
            if (count($result) > 0) {
                $settings = $this->Settings->buildSettings($result['Sites'], $result['Settings']);
		$this->theme = $settings['theme'];
                // Override if we are admin!
                if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {
                    $this->theme = 'admin';
                }
		// Load Theme configs
		//echo APP . 'View' . DS . 'Themed' . DS . ucfirst($this->theme);
		Configure::config('themeconfig', new PhpReader(APP . 'View' . DS . 'Themed' . DS . ucfirst($this->theme) . DS));
		Configure::load($this->theme.'conf', 'themeconfig',true);
		//print_r(Configure::read());
                $this->set('meta_keywords',(!@$settings['meta_keywords']!='')?@$settings['meta_keywords']:'League Launch,Sports Team management,League,Soccer,Baseball,Football,Hockey');
                $this->set('meta_description',(!@$settings['meta_description']!='')?@$settings['meta_description']:'LeagueLaunch.com :: League Management Made Easy');
                $this->set('domain', $domain);
                $this->set('settings', $settings);
            } else {
                $this->set('meta_keywords','League Launch,Sports Team management,League,Soccer,Baseball,Football,Hockey');
                $this->set('meta_description','LeagueLaunch.com :: League Management Made Easy');
                throw new NotFoundException($domain.' Was not found or is misconfigured');
            }
        } else {
            $this->set('meta_keywords','League Launch,Sports Team management,League,Soccer,Baseball,Football,Hockey');
            $this->set('meta_description','LeagueLaunch.com :: League Management Made Easy');
            throw new NotFoundException($domain.' Was not found or is misconfigured');
        }
    }

    public function beforeRender() {
        parent::beforeRender();
    }

    public function getDomain() {
        if (strpos($_SERVER['SERVER_NAME'], 'leaguelaunch.com')) {
            $domain = str_replace('.leaguelaunch.com', '', str_replace('www.', '', $_SERVER['SERVER_NAME']));
        } else {
            $domain = str_replace('www.', '', $_SERVER['SERVER_NAME']);
        }

        return $domain;
    }

}
