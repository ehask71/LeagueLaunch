<?php
/**
 * CakePHP SeoController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class SeoController extends AppController {
    
    public $name = 'SeoController';
    
    public function beforeFilter() {
	parent::beforeFilter();
    }
    
    public function robots(){
        $urls = array();
        
        $urls[] = '/contact';
        
        
        $this->set(compact('urls'));  
        $this->RequestHandler->respondAs('text');  
        $this->viewPath .= '/text';  
        $this->layout = 'ajax'; 
    }
    
}

