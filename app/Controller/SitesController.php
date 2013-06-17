<?php

/**
 * CakePHP SitesController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class SitesController extends AppController {

    public $name = 'Sites';
    public $uses = array('Settings', 'Sites','Country','Sports');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function index() {
        $this->redirect('/');
    }

    public function admin_settings() {
        $id = Configure::read('Settings.site_id');
        $this->Settings->site_id = $id;
        if ($this->request->is('post')) {
            if ($this->request->data) {
		$this->Settings->updateKeyVal($this->request->data);
                $this->Session->setFlash('Settings Saved!');
                $this->redirect('/admin/sites/settings');
            }
        }
	$this->request->data = $this->Settings->buildPopulateArray();
    }

    public function admin_account() {
        $siteid = Configure::read('Settings.site_id');
	$this->set('countries',$this->Country->getCountries());
	$this->set('sports',$this->Sports->getSports());
        if ($this->request->isPut()) {
            $this->Sites->set($this->data);
            if ($this->Sites->siteValidate()) {
                $this->Sites->save($this->request->data, false);
                $this->Session->setFlash(__('Your account has been successfully updated'));
                $this->redirect('/admin/sites/account');
            }
        } else {
            $site = $this->Sites->read(null, $siteid);
            $this->request->data = null;
            if (!empty($site)) {
                $this->request->data = $site;
            }
        }
    }
    
    /**
     *   Register a Site/League
     */
    public function register(){
        
    }

}

