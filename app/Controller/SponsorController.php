<?php
/**
 * CakePHP SponsorController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class SponsorController extends AppController {
    
    public $name = 'Sponsor';
    
    public function beforeFilter() {
	parent::beforeFilter();
    }
    
    public function index(){
        
    }
    
}

