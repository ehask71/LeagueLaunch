<?php

/**
 * CakePHP RegistrationController
 * @author Eric
 */
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class RegistrationController extends AppController {

    public $name = 'Registration';
    public $uses = array('Products', 'Forms', 'Players', 'Registration','ProductsToRegistrations');
    public $components = array('MathCaptcha', 'RequestHandler', 'Cookie');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index');
    }

    // Admin 
    public function admin_index() {
        $registrations = $this->Registration->find('all', array(
            'conditions' => array('Registration.site_id' => Configure::read('Settings.site_id'))
                ));

        $this->set(compact('registrations'));
    }

    public function admin_new() {
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Registration->validateRegistration()) {
                $this->request->data['Registration']['created'] = DboSource::expression('NOW()');
                if ($this->Registration->save($this->request->data)) {
                    $id = $this->Registration->getLastInsertID();
                    $this->redirect('/admin/registration/addproducts/'.$id);
                }
            }
        }
    }

    public function admin_addproducts($id){
        if ($this->request->is('post') || $this->request->is('put')) {
            if($this->Products->validateRegProduct()){
                $reg_id = $this->request->data['Products']['reg_id'];
                unset($this->request->data['Products']['reg_id']);
                if($this->Products->save($this->request->data())){
                    // Add to the pivot table
                    
                }
            }
        }
        $this->set('regid',$id);
    }
    
    public function index() {
        
    }

    // Show Players & Assign Registrations
    // Allow Players to be Added
    public function step1() {
        $user = $this->Auth->user();
        $registration_options = $this->Products->getRegistrationDropDown();
        $players = $this->Players->getPlayersByUser($user['id'], Configure::read('Settings.site_id'));
        $this->set(compact('registration_options'));
        $this->set(compact('players'));
    }

    // Add to Cart the Items 
    public function step2() {
        $this->set('form', $this->request->data);
    }

    public function step3() {
        
    }

    public function saveplayer() {
        $this->autoRender = false;
        if ($this->RequestHandler->isAjax()) {
            if ($this->Players->save($this->request->data)) {
                echo '<b>' . $this->request->data['Players']['firstname'] . ' ' . $this->request->data['Players']['lastname'] . ' Added!</b>';
            }
            return false;
        }
    }

}

