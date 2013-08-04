<?php
/**
 * CakePHP SeasonsController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class SeasonController extends AppController {
    
    public $name = 'Season';
    public $uses = array('Season');
    
    public function beforeFilter() {
	parent::beforeFilter();
    }
    
    public function index(){
        
    }
    
    public function admin_index(){
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
}

