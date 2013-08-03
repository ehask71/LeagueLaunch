<?php
/**
 * CakePHP StaffController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class StaffController extends AppController {
    
    public $name = 'Staff';
    
    public function beforeFilter() {
	parent::beforeFilter();
        $this->Auth->allow('index','coaches','board');
    }
    
    public function index(){
        
    }
    
    public function board(){
        
    }
    
    public function coaches(){
        
    }
    
}

