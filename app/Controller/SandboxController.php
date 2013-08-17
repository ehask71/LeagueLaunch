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
        $this->Auth->allow();
    }
    
    public function index(){
        
    }
    
    public function testiframe(){
        
    }
    
}

