<?php
/**
 * CakePHP ScheduleController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class ScheduleController extends AppController {
    
    public $name = 'Schedule';
    
    public function beforeFilter() {
	parent::beforeFilter();
        $this->Auth->allow('index');
    }
    
    public function index(){
        
    }
    
}

