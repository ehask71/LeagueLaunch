<?php

/**
 * CakePHP RegistrationController
 * @author Eric
 */
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class RegistrationController extends AppController {

    public $name = 'Registration';
    public $uses = array('Products', 'Forms', 'Players', 'Registration', 'ProductsToRegistrations');
    public $components = array('MathCaptcha', 'RequestHandler', 'Cookie', 'Cart');

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
                    $this->Session->write('NewRegistration.regid', $id);
                    $this->redirect('/admin/registration/addproducts/' . $id);
                }
            }
        }
    }

    public function admin_addproducts() {
        $site_id = Configure::read('Settings.site_id');
        $id = $this->Session->read('NewRegistration.regid');

        if (!$id) {
            $this->Session->setFlash(__('Missing Registration Id!'));
            $this->redirect('/admin/registration/');
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Products->validateRegProduct()) {
                $reg_id = $this->request->data['Products']['regid'];
                $this->request->data['site_id'] = $site_id;
                unset($this->request->data['Products']['regid']);

                if ($this->Products->save($this->request->data)) {
                    $product_id = $this->Products->getLastInsertID();
                    // Add to the pivot table
                    $data = array();
                    $data['regid'] = $reg_id;
                    $data['product_id'] = $product_id;
                    $data['site_id'] = $site_id;
                    if ($this->ProductsToRegistrations->save($data)) {
                        $this->Session->setFlash(__('Product Saved!'));
                        $this->redirect('/admin/registration/addproducts/');
                    }
                }
            }
        }
        $products = $this->ProductsToRegistrations->find('all', array(
            'conditions' => array(
                'ProductsToRegistrations.regid' => $id,
                'Product.category_id' => 1
            ),
            'joins' => array(
                array('table' => 'products', 'alias' => 'Product', 'type' => 'INNER', 'conditions' => array(
                        'ProductsToRegistrations.product_id = Product.id'
                ))
            ),
            'fields' => array(
                'Product.*', 'ProductsToRegistrations.*'
            )
                ));
        $this->set(compact('products'));
        $this->set('regid', $id);
    }

    public function admin_addupsells() {
        $site_id = Configure::read('Settings.site_id');
        $id = $this->Session->read('NewRegistration.regid');

        if (!$id) {
            $this->Session->setFlash(__('Missing Registration Id!'));
            $this->redirect('/admin/registration/');
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Products->validateRegProduct()) {
                $reg_id = $this->request->data['Products']['regid'];
                $this->request->data['site_id'] = $site_id;
                unset($this->request->data['Products']['regid']);

                if ($this->Products->save($this->request->data)) {
                    $product_id = $this->Products->getLastInsertID();
                    // Add to the pivot table
                    $data = array();
                    $data['regid'] = $reg_id;
                    $data['product_id'] = $product_id;
                    $data['site_id'] = $site_id;
                    if ($this->ProductsToRegistrations->save($data)) {
                        $this->Session->setFlash(__('Upsell Saved!'));
                        $this->redirect('/admin/registration/addupsells/');
                    }
                }
            }
        }
        $products = $this->ProductsToRegistrations->find('all', array(
            'conditions' => array(
                'ProductsToRegistrations.regid' => $id,
                'Product.category_id' => 2
            ),
            'joins' => array(
                array('table' => 'products', 'alias' => 'Product', 'type' => 'INNER', 'conditions' => array(
                        'ProductsToRegistrations.product_id = Product.id'
                ))
            ),
            'fields' => array(
                'Product.*', 'ProductsToRegistrations.*'
            )
                ));
        $this->set(compact('products'));
        $this->set('regid', $id);
    }

    public function index() {
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->request->data['Registration']['id'] != '') {
                $this->Session->write('Registration.id', $this->request->data['Registration']['id']);
                $this->redirect(array('action' => 'step1'));
            } else {
                $this->Session->setFlash(__('Missing Registration Id. Try Again'), 'alerts/error');
                $this->redirect('/registration');
            }
        }
        $registrations = $this->Registration->getRegistrations();
        $this->set(compact('registrations'));
    }

    // Show Players & Assign Registrations
    // Allow Players to be Added
    public function step1($id) {
        $id = $this->Session->read('Registration.id');
        // Store Results in Sessions
        if ($this->request->is('post') || $this->request->is('put')) {
            if (count($this->request->data['Players']) > 0) {
                foreach ($this->request->data['Players'] AS $k => $v) {
                    $this->Cart->add($v, 1);
                    $player = $this->Players->getPlayerById($k);
                    $this->Session->write('Player.' . $k . '.product', $v);
                    $this->Session->write('Player.' . $k . '.player', $player['Players']['firstname'] . ' ' . $player['Players']['lastname']);
                }
                $this->redirect(array('action' => 'step2'));
            }
        }
        if ($id) {
            $user = $this->Auth->user();
            $registration_options = $this->ProductsToRegistrations->getRegistrationsDropdown($id);
            $players = $this->Players->getPlayersByUser($user['id'], Configure::read('Settings.site_id'));
            $this->set(compact('registration_options'));
            $this->set(compact('players'));
        } else {
            $this->Session->setFlash(__('Please Select A Registration First'), 'alerts/info');
            $this->redirect('/registration');
        }
    }

    // Add to Cart the Items 
    // Display Upsells and Requirements
    public function step2() {
        if ($this->request->is('post') || $this->request->is('put')) {
            if (count(@$this->request->data['Upsell']) > 0) {
                foreach ($this->request->data['Upsell'] AS $k => $v) {
                    if ($v == 'yes') {
                        $this->Cart->add($k, 1);
                    }
                }
                $this->redirect(array('action' => 'step3'));
            }
        }
        if (count($this->Session->read('Player')) > 0 && isset($this->Session->read('Registration.id'))) {
            $this->set('upsells', $this->ProductsToRegistrations->getUpSells($this->Session->read('Registration.id')));
            $shop = $this->Session->read('Shop');
            $this->set(compact('shop'));
        } else {
            $this->Session->setFlash(__('No Players Selected'), 'alerts/error');
            $this->redirect('/registration/step1');
        }
    }

    //   Address
    public function step3() {
        $shop = $this->Session->read('Shop');
        if (!$shop['Order']['total']) {
            $this->Session->setFlash(__('No Registration Items!','alerts/error'));
            $this->redirect('/registration');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            
        }
        $this->set('data', $this->request->data);
        $shop = $this->Session->read('Shop');
        $this->set(compact('shop'));
        $this->set('players', $this->Session->read('Player'));
    }

    public function review() {
        $this->set('data', $this->request->data);
        $shop = $this->Session->read('Shop');
        $this->set(compact('shop'));
        $this->set('players', $this->Session->read('Player'));
    }

    public function paypal() {
        
    }

    public function authnet() {
        
    }

    public function clear() {
        $this->Cart->clear();
        $this->Session->setFlash('All item(s) removed from your shopping cart', 'alerts/info');
        $this->redirect('/registration');
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

