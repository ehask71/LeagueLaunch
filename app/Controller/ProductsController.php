<?php
/**
 * CakePHP ProductsController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class ProductsController extends AppController {
    
    public $name = 'Products';
    
    public function beforeFilter() {
	parent::beforeFilter();
    }
    
    public function index(){
        
    }
    
}

