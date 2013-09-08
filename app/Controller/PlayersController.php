<?php
/**
 * CakePHP PlayersController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class PlayersController extends AppController {
    
    public $name = 'Players';
    
    public function beforeFilter() {
	parent::beforeFilter();
    }
    
    public function index(){
        
    }
    
}

