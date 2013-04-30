<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {
    public $viewClass   = 'Theme';
    public $theme = 'default';
    public $uses = array('TblSettings','TblSites');
    
    public function beforeFilter() {
	
	$domain = $this->getDomain();
	if($this->TblSites->getSiteId($domain)){
	    $settings = $this->TblSettings->getSiteSettings($domain);
	    $this->set('domain',$domain);
	    $this->set('settings',$settings);
	}
    }
    
    public function beforeRender() {
	parent::beforeRender();
	//$this->viewClass = 'Theme';
	//$this->theme = 'default';
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
