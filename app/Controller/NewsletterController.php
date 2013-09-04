<?php
/**
 * CakePHP NewsletterController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class NewsletterController extends AppController {
    
    public $name = 'Newsletter';
    
    public function beforeFilter() {
	parent::beforeFilter();
    }
    
    public function index(){
        
    }
    
}

