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
    public $components = array('MathCaptcha', 'RequestHandler', 'Cookie', 'Cart', 'Paypal');
    public $helpers = array('PaypalIpn.Paypal');

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
    public function step1() {
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
        if (count($this->Session->read('Player')) > 0 && $this->Session->read('Registration.id') != '') {
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
            $this->Session->setFlash(__('No Registration Items!', 'alerts/error'));
            $this->redirect('/registration');
        }
        $this->loadModel('Order');
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Order->set($this->request->data);
            if ($this->Order->validates()) {
                $order = $this->request->data['Order'];
                //$order['order_type'] = 'creditcard';
                $this->Session->write('Shop.Order', $order + $shop['Order']);
                /* if ($this->request->data['Order']['order_type'] == 'paypal') {
                  $this->redirect(array('action' => 'paypalstep1'));
                  } */
                $this->redirect(array('action' => 'review'));
            } else {
                $this->Session->setFlash('The form could not be saved. Please, try again.', 'alerts/error');
            }
        }

        $shop = $this->Session->read('Shop');
        $this->set(compact('shop'));
        $this->set('players', $this->Session->read('Player'));
        $this->set('payment_types', $this->Order->getAcceptedPayment());
    }

    public function review() {
        $this->set('data', $this->request->data);
        $shop = $this->Session->read('Shop');

        if ($this->request->is('post')) {

            $this->loadModel('Order');

            $this->Order->set($this->request->data);
            if ($this->Order->validates()) {
                $order = $shop;
                $order['Order']['status'] = 1;
                $order['Order']['site_id'] = Configure::read('Settings.site_id');

                $save = $this->Order->saveAll($order, array('validate' => 'first'));

                if ($save) {
                    $orderid = $this->Order->getLastInsertID();
                    $shop['Order']['order_id'] = $orderid;
                    $this->Session->write('Shop.Order.order_id', $orderid);
                    $shop['Order']['regid'] = $this->Session->read('Registration.id');
                    $this->Session->write('Shop.Order.regid', $shop['Order']['regid']);
                    
                    // Do the insert for Player_to_Registrations
                    
                    if ((Configure::read('Settings.paypal_enabled') == 'true') && $shop['Order']['order_type'] == 'paypal') {
                        $this->redirect(array('action' => 'paypal'));
                    }

                    if ((Configure::read('Settings.authorize_net_enabled') == 'true') && $shop['Order']['order_type'] == 'authnet') {
                        $this->redirect(array('action' => 'cc'));
                    }

                    if ($shop['Order']['order_type'] == 'payatfield') {
                        $this->set(compact('shop'));
                        App::uses('CakeEmail', 'Network/Email');
                        $email = new CakeEmail();
                        $email->from(array('do-not-reply@leaguelaunch.com' => Configure::read('Settings.leaguename')))
                                ->sender(Configure::read('Settings.admin_email'))
                                ->replyTo(Configure::read('Settings.admin_email'))
                                ->cc(Configure::read('Settings.admin_email'))
                                ->to($shop['Order']['email'])
                                ->subject(Configure::read('Settings.leaguename') . ' Order')
                                ->template('registrationcod')
                                ->theme(Configure::read('Settings.theme'))
                                ->emailFormat('text')
                                ->viewVars(array('shop' => $shop))
                                ->send();
                        $this->redirect(array('action' => 'success'));
                    }
                } else {
                    $errors = $this->Order->invalidFields();
                    $this->set(compact('errors'));
                }
            }
        }

        $this->set(compact('shop'));
        $this->set('players', $this->Session->read('Player'));
    }

    public function paypal() {
        $shop = $this->Session->read('Shop');
        $this->set(compact('shop'));
        $this->render('paypal');
    }

    public function cc() {
        
    }

    public function success() {
        $shop = $this->Session->read('Shop');
        $this->Cart->clear();
        if (empty($shop)) {
            $this->redirect('/');
        }
        $this->set(compact('shop'));
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

