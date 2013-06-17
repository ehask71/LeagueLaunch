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
	$divisions = $this->Divisions->find('all', array(
	    'conditions' => array(
		'Divisions.site_id' => Configure::read('Settings.site_id')
	    )
		));
	$this->set('divisions', $divisions);
    }

    public function admin_index() {
	if ($this->request->is('post')) {
	    if ($this->Divisions->divisionValidate()) {
		$this->Divisions->save($this->request->data, false);
		$this->Session->setFlash(__('The Division was Added!'));
		$this->redirect('/admin/divisions');
	    }
	}
	$divisions = $this->Divisions->find('all', array(
	    'conditions' => array(
		'Divisions.site_id' => Configure::read('Settings.site_id')
	    )
		));
	print_r($divisions);
	$this->set('divisions', $divisions);
    }

}

