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
	$this->Settings->site_id = $id; 
	if ($this->request->is('post')) {
            if($this->Settings->save($this->request->data)){
                $this->Session->setFlash('Settings Saved!');
                //$this->redirect('/admin/sites/settings');
            } 
	}
	$this->set('settings', $this->Settings->find('bysiteid'));
        $this->set('sub',$this->request->data);
    }
    
}

