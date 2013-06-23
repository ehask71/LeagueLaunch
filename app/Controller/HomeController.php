<?php
App::uses('AppController', 'Controller');

class HomeController extends AppController {
    
    public $helpers = array('Cache');
    public $cacheAction = "1 hour";
    public $name = 'Home';
    
    public function beforeFilter() {
	parent::beforeFilter();
	$this->Auth->allow('index');
    }
    
    public function index(){

    }
    
    public function admin_index(){
	
    }
    
    public function admin_settings(){
	
    }

    public function notconfigured(){
        
    }
    
}

?>
