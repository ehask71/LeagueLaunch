<?php
/**
 * CakePHP StandingsController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class StandingsController extends AppController {
    
    public $name = 'Standings';
    
    public function beforeFilter() {
	parent::beforeFilter();
        $this->Auth->allow('index');
    }
    
    public function index(){
        
    }
    
}

