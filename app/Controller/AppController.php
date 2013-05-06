<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {
    public $viewClass   = 'Theme';
    public $theme = 'default';
    public $uses = array('Settings','Sites');
    
    /*public $components = array(
		'Session',
		'Auth'
	);*/

    public function beforeFilter() {
	
	$domain = $this->getDomain();
	if($this->Sites->getSiteId($domain)){
	    $result = $this->Sites->find('first',array(
		'conditions' => array(
		    'Sites.domain'=>$domain,
		    'Sites.isactive'=>'yes')
	    ));
	    if(count($result)>0){
		$settings = $this->Settings->buildSettings($result['Sites'],$result['Settings']);
		print_r($settings);
		$this->set('domain',$domain);
		$this->set('settings',$settings);
	    }
	}
    }
    
    public function beforeRender() {
	parent::beforeRender();
    }
    public function getDomain(){
	if(strpos($_SERVER['SERVER_NAME'], 'leaguelaunch.com')){
	    $domain = str_replace('.leaguelaunch.com','',str_replace('www.', '', $_SERVER['SERVER_NAME']));
	} else {
	    $domain = str_replace('www.', '', $_SERVER['SERVER_NAME']);
	}
	
	return $domain;
    }
}
