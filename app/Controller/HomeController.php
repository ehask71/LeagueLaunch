<?php
App::uses('AppController', 'Controller');

class HomeController extends AppController {
    
    public $helpers = array('Cache');
    public $cacheAction = array(
	'index' => array('callbacks' => true, 'duration' => 48000)
    );
    public $name = 'Home';
    
    public function beforeFilter() {
	parent::beforeFilter();
	$this->Auth->allow('index');
    }
    
    public function index(){
	$this->Session->setFlash('Hey Rob its a Message!!','alerts/info');
    }
    
    public function admin_index(){
	
    }
    
    public function admin_settings(){
	
    }

    public function notconfigured(){
        
    }
    
}

?>
