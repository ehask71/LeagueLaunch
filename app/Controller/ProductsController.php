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
    
    public function admin_index(){
	
    }
    
    public function admin_add(){
	if($this->request->is('post')){
	    
	}
    }
    
    public function admin_category(){
	if($this->request->is('post')){
	    
	}
    }
    
}

