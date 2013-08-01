<?php
/**
 * CakePHP RegistrationController
 * @author Eric
 */
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class RegistrationController extends AppController {
    
    public $name = 'Registration';
    
    public $uses = array('Products','Forms','Players');
    
    
    public function beforeFilter() {
	parent::beforeFilter();
	$this->Auth->allow('index');
    }
    
    public function index(){
        
    }
    
    public function step1(){
        $user = $this->Auth->user();
        $registration_options = $this->Products->getRegistrationDropDown();
	$players = $this->Players->getPlayersByUser($user['id'], Configure::read('Settings.site_id'));
	$this->set(compact('registration_options'));
        $this->set(compact('players'));
    }
    /*
     *    Show Registrations Available
     */
    public function step2(){
        
    }
    
    public function step3(){
        
    }
}

