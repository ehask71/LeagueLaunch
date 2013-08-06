<?php

/**
 * CakePHP RegistrationController
 * @author Eric
 */
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class RegistrationController extends AppController {

    public $name = 'Registration';
    public $uses = array('Products', 'Forms', 'Players', 'Registration', 'Divisions', 'Season', 'ProductsToRegistrations');
    public $components = array('MathCaptcha', 'RequestHandler', 'Cookie', 'Cart', 'LeagueAge');
    public $helpers = array('PaypalIpn.Paypal');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index');
    }

    // Admin 
    public function admin_index() {
        $registrations = $this->Season->find('all', array(
            'conditions' => array('Season.site_id' => Configure::read('Settings.site_id'),
                'and' => array(
                    array('News.start_date <= ' => date('Y-m-d H:i:s'), 'News.end_date >= ' => date('Y-m-d H:i:s'))
                )
            )
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
        if($_SERVER['REMOTE_ADDR'] != '108.9.106.22'){
            $this->Session->setFlash('Temporarily Under Going Maintenance', 'alerts/info');
            $this->redirect('/');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->request->data['Season']['id'] != '') {
                $this->Session->write('Season.id', $this->request->data['Season']['id']);
                $this->redirect(array('action' => 'step1'));
            } else {
                $this->Session->setFlash(__('Missing Registration Id. Try Again'), 'alerts/error');
                $this->redirect('/registration');
            }
        }
        $registrations = $this->Season->getOpenSeasons();
        $this->set(compact('registrations'));
    }

    // Show Players & Assign Registrations
    // Allow Players to be Added
    public function step1() {
        $id = $this->Session->read('Season.id');
        $pcheck = $this->Session->read('Shop.players_added');
        if ($pcheck == 'true') {
            //$this->Session->setFlash('Please Don\'t Use The Back Button', 'alerts/info');
            $this->redirect(array('action' => 'step2'));
        }
        // Store Results in Sessions
        if ($this->request->is('post') || $this->request->is('put')) {
            if (count($this->request->data['Players']) > 0) {
                $season = $this->Session->read('Season.id');
                foreach ($this->request->data['Players'] AS $k => $v) {
                    
                    $product = $this->Products->getProductsByDivision($v, $this->Session->read('Season.id'));
                    mail('ehask71@gmail.com','Cart',$k.' '.$v.' '.$this->Session->read('Season.id').' '.print_r($product,1));
                    $this->Cart->add($product['Products']['id'], 1, $k, $season);
                    $player = $this->Players->getPlayerById($k);
                    // Set Some Stuff
                    $this->Session->write('Player.' . $k . '.product', $product['Products']['id']);
                    $this->Session->write('Player.' . $k . '.division', $v);
                    $this->Session->write('Player.' . $k . '.player', $player['Players']['firstname'] . ' ' . $player['Players']['lastname']);
                    $this->Session->write('Shop.Order.Player.' . $k . '.product', $product['Products']['id']);
                    $this->Session->write('Shop.Order.Player.' . $k . '.division', $v);
                    $this->Session->write('Shop.Order.Player.' . $k . '.player', $player['Players']['firstname'] . ' ' . $player['Players']['lastname']);
                }
                $this->Session->write('Shop.players_added', 'true');
                $this->redirect(array('action' => 'step2'));
            }
        }
        if ($id) {
            $user = $this->Auth->user();
            //$registration_options = $this->ProductsToRegistrations->getRegistrationsDropdown($id);
            $registration_options = $this->Divisions->getParentDivisionsWproduct();
            $players = $this->Players->getPlayersByUser($user['id'], Configure::read('Settings.site_id'));
            $prepared_data = $this->LeagueAge->limitAgeBasedOptions($players, $registration_options);
            $this->set(compact('prepared_data'));
            $this->set(compact('players'));
        } else {
            $this->Session->setFlash(__('Please Select A Registration First'), 'alerts/info');
            $this->redirect('/registration');
        }
    }

    // Add to Cart the Items 
    // Display Upsells and Requirements
    public function step2() {
        $backcheck = $this->Session->read('Shop.upsell_added');
        if ($backcheck == 'true') {
            //$this->Session->setFlash('Please Don\'t Use The Back Button', 'alerts/info');
            $this->redirect(array('action' => 'step3'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if (count(@$this->request->data['Upsell']) > 0) {
                foreach ($this->request->data['Upsell'] AS $k => $v) {
                    if ($v == 'yes') {
                        $this->Cart->add($k, 1);
                    }
                }
                $this->Session->write('Shop.upsell_added', 'true');
                $this->redirect(array('action' => 'step3'));
            } else {
		$this->redirect(array('action' => 'step3'));
	    }
        }
        if (count($this->Session->read('Player')) > 0 && $this->Session->read('Season.id') != '') {
            $upSells = $this->Products->getUpSells();
            if (count($upSells) > 0) {
                $this->set('upsells', $this->Products->getUpSells());
                $shop = $this->Session->read('Shop');
                $this->set(compact('shop'));
            } else {
                $this->redirect(array('action' => 'step3'));
            }
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
                $this->Session->write('Shop.Order', $order + $shop['Order']);
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
                    $shop['Order']['season_id'] = $this->Session->read('Season.id');
                    $this->Session->write('Shop.Order.season_id', $shop['Order']['season_id']);

                    // Do the insert for Player_to_Registrations
                    $this->loadModel('PlayersToSeasons');
                    foreach ($shop['Order']['Player'] AS $k => $v) {
                        $sid = $this->PlayersToSeasons->saveAll($this->PlayersToSeasons->addPlayer($shop['Order']['season_id'], $k, $v['division'], $v['product']));
                    }

                    if ((Configure::read('Settings.paypal_enabled') == 'true') && $shop['Order']['order_type'] == 'paypal') {
                        $this->redirect(array('action' => 'paypal'));
                    }

                    if ((Configure::read('Settings.authorize_net_enabled') == 'true') && $shop['Order']['order_type'] == 'authnet') {
                        $this->redirect(array('action' => 'cc'));
                    }

                    if ($shop['Order']['order_type'] == 'payatfield') {
                        $this->redirect(array('action' => 'success'));
                    }
                } else {
                    $errors = $this->Order->invalidFields();
                    $this->set(compact('errors'));
                }
            }
        }
        switch($shop['Order']['order_type']){
            case "paypal":
                $paytype = 'PayPal';
                break;
            case "payatfield":
                $paytype = 'Pay At The Field';
                break;
            case "authnet":
                $paytype = 'Visa/MC';
                break;
        }
        $this->set('paytype',$paytype);
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
            $this->request->data['Players']['league_age'] = $this->LeagueAge->calculateLeagueAge($this->request->data['Players']['birthday']);
            if ($this->Players->save($this->request->data)) {
                echo '<div class="ll-alert-success">' . $this->request->data['Players']['firstname'] . ' ' . $this->request->data['Players']['lastname'] . ' has been Added!</div>';
            }
            return false;
        }
    }

}

