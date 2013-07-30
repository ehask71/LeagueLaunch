<?php
/**
 * CakePHP RegistrationController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class RegistrationController extends AppController {
    
    public $name = 'RegistrationController';
    
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

