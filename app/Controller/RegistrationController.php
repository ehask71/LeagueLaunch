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
    }
    
    public function index(){
        
    }
    
}
