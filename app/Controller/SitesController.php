<?php
/**
 * CakePHP SitesController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class SitesController extends AppController {
    
    public $name = 'Sites';
    public $uses = array('Settings');
    
    public function beforeFilter() {
	parent::beforeFilter();
    }
    
    public function index(){
        $this->redirect('/');
    }
    
    public function admin_settings(){
	$id = Configure::read('Settings.site_id');
	if ($this->request->is('post')) {
	    echo "<pre>";
	    print_r($this->request->data);
	}
	$this->set('settings', $this->Settings->findById($id));
    }
    
}

