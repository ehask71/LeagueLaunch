<?php
/**
 * CakePHP FormsController
 * @author Eric
 */
App::uses('AppController', 'Controller');

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
        if ($this->request->is('post')) {
            /*require_once(APP.'Vendor'.DS.'Formbuilder/Formbuilder.php');
	    $builder = new Formbuilder($this->request->data);
            $this->Forms->save($builder)or die(mysql_error());
            $this->Session->setFlash(__('The Form was Added!'),'default',array('class'=>'alert succes_msg'));
	    */
            mail('ehask71@gmail.com','Form Save',print_r($this->request->data,1));
            
            $this->redirect('/admin/forms');
	}
    }
    
    public function admin_load(){
	$this->autoRender = false;
    }
    
    public function admin_save(){
        $this->autoRender = false;
	if ($this->request->is('post')) {
            /*require_once(APP.'Vendor'.DS.'Formbuilder/Formbuilder.php');
	    $builder = new Formbuilder($this->request->data);*/
            $this->Forms->save($this->request->data);
            //$this->Session->setFlash(__('The Form was Added!'),'default',array('class'=>'alert succes_msg'));
            //$this->redirect('/admin/forms');
	    mail('ehask71@gmail.com','Form Save',print_r($builder->get_encoded_form_array(),1));
	}
        debug($this->Forms->validationErrors);
    }
}

