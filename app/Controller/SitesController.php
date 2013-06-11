<?php
/**
 * CakePHP SitesController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class SitesController extends AppController {
    
    public $name = 'Sites';
    
    public function beforeFilter() {
	parent::beforeFilter();
    }
    
    public function index(){
        $this->redirect('/');
    }
    
    public function admin_settings(){
	
    }
    
}

