<?php
/**
 * CakePHP SponsorController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class SponsorsController extends AppController {
    
    public $name = 'Sponsors';
    
    public function beforeFilter() {
	parent::beforeFilter();
    }
    
    public function index(){
        
    }
    
}

