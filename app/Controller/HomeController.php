<?php
App::uses('AppController', 'Controller');

class HomeController extends AppController {
    
    public $name = 'Home';
    
    public function beforeFilter() {
	parent::beforeFilter();
	$this->Auth->allow('index');
    }
    
    public function index(){

    }
    
    public function admin_index(){
	
    }
    
    public function notconfigured(){
        
    }
    
}

?>
