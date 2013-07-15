<?php
/**
 * CakePHP FormsController
 * @author Eric
 */
App::uses('AppController', 'Controller');
App::import('Vendor','Formbuilder');

class FormsController extends AppController {
    
    public $uses = array('Forms');
    
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
    
    public function admin_new(){
        
    }
    
    public function admin_load(){
	$this->autoRender = false;
    }
    
    public function admin_save(){
        $this->autoRender = false;
	if ($this->request->is('post')) {
            require_once(App::path('Vendor').'Formbuilder.php');
	    $builder = new Formbuilder($this->request->data);
	    mail('ehask71@gmail.com','Form Save',print_r($builder->get_encoded_form_array(),1));
	}
    }
}

