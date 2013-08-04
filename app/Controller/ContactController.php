<?php
/**
 * CakePHP ContactController
 * @author Eric
 */
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class ContactController extends AppController {
    public $name = 'Contact';
    
    public function beforeFilter() {
	parent::beforeFilter();
        $this->Auth->allow('index');
    }
    
    public function index(){
        
        $this->set('title_for_layout','Contact Us');
    }
    
}
