<?php
/**
 * CakePHP FormsController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class FormsController extends AppController {

    public function beforeFilter() {
	parent::beforeFilter();
    }
    
    public function index(){
        
    }
    
    public function admin_index(){
        $this->paginate = array(
	    'conditions' => array(
		'Forms.site_id' => Configure::read('Settings.site_id')
	    ) 
	);
        $forms = $this->paginate('Forms');
	$this->set('title_for_layout',__('Forms'));
        $this->set('forms',$forms);
    }
    
}

