<?php

/**
 * CakePHP DivisionsController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class DivisionsController extends AppController {

    var $uses = array('Divisions');

    public function beforeFilter() {
	parent::beforeFilter();
    }

    public function index() {
	$this->paginate = array(
	    'conditions' => array(
		'Divisions.site_id' => Configure::read('Settings.site_id')
	    ) 
	);
	$divisions = $this->paginate('Divisions');
	$this->set(compact('divisions'));
    }

    public function admin_index() {
	if ($this->request->is('post')) {
	    if ($this->Divisions->divisionValidate()) {
		$this->Divisions->save($this->request->data, false);
		$this->Session->setFlash(__('The Division was Added!'),'default',array('class'=>'alert succes_msg'));
		$this->redirect('/admin/divisions');
	    }
	}
	$this->paginate = array(
	    'conditions' => array(
		'Divisions.site_id' => Configure::read('Settings.site_id')
	    ) 
	);
	$divisions = $this->paginate('Divisions');
	$this->set(compact('divisions'));
    }
    
    public function admin_delete($id){
	$this->Divisions->id = $id;
	if(!$this->Divisions->exists()){
	    $this->Session->setFlash(__('Division doesn\'t Exist'),'default',array('class'=>'alert error_msg'));
	    $this->redirect('/admin/divisions');
	}
	if($this->Divisions->delete()){
	    $this->Session->setFlash(__('Division Deleted'),'default',array('class'=>'alert succes_msg'));
	    $this->redirect('/admin/divisions');
	}
	$this->Session->setFlash(__('Unable To Delete Division'),'default',array('class'=>'alert error_msg'));
	$this->redirect('/admin/divisions');
    }

}

