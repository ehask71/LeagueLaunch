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
	
    }

    public function admin_index() {
	if ($this->request->isPut()) {
	    
	} else {
	    $divisions = $this->Divisions->find('all', array(
		'conditions' => array(
		    'Divisions.site_id' => Configure::read('Settings.site_id')
		)
		    ));
	    $this->set('divisions', $divisions);
	}
    }

}

