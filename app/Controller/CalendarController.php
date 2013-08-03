<?php
/**
 * CakePHP CalendarController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class CalendarController extends AppController {

        
    public function beforeFilter() {
	parent::beforeFilter();
        $this->Auth->allow('index');
    }
    
    public function index(){
        
    }
    
}

