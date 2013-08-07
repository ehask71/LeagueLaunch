<?php
/**
 * CakePHP SandboxController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class SandboxController extends AppController {
    
    public $name = 'Sandbox';
    
    public function beforeFilter() {
	parent::beforeFilter();
    }
    
    public function index(){
        
    }
    
}

