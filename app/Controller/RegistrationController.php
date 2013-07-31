<?php
/**
 * CakePHP RegistrationController
 * @author Eric
 */
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class RegistrationController extends AppController {
    
    public $name = 'Registration';
    
    public $uses = array('Products','Forms');
    
    
    public function beforeFilter() {
	parent::beforeFilter();
	$this->Auth->allow('index');
    }
    
    public function index(){
        
    }
    
    public function step2(){
        
    }
    
    public function step3(){
        
    }
}

