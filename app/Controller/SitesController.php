<?php

/**
 * CakePHP SitesController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class SitesController extends AppController {

    public $name = 'Sites';
    public $uses = array('Settings', 'Sites','Country','Sports');
    public $components = array('AuthorizeNet');

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
                $this->Session->setFlash(__('Your account has been successfully updated'),'default',array('class'=>'alert succes_msg'));
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
    
    public function admin_terminal() {
        if ($this->request->is('post')) {
            $this->loadModel('Order');
            if ($this->Order->validateTerminal($this->request->data)) {
                $data['total'] = $this->request->data['Order']['creditcard_amount'];
                $data['first_name'] = $this->request->data['Order']['cardholder_firstname'];
                $data['last_name'] = $this->request->data['Order']['cardholder_lastname'];
                $data['billing_address'] = $this->request->data['Order']['cardholder_address'];
                $data['billing_city'] = $this->request->data['Order']['cardholder_city'];
                $data['billing_state'] = $this->request->data['Order']['cardholder_state'];
                $data['billing_zip'] = $this->request->data['Order']['cardholder_zip'];
                $data['phone'] = $this->request->data['Order']['cardholder_phone'];
                $data['email'] = $this->request->data['Order']['cardholder_email'];
                $payment['creditcard_number'] = $this->request->data['Order']['creditcard_number'];
		$payment['creditcard_month'] = $this->request->data['Order']['creditcard_month']; 
                $payment['creditcard_year'] = $this->request->data['Order']['creditcard_year'];
                $payment['creditcard_code'] = $this->request->data['Order']['creditcard_code'];
                
                $authorizeNet = $this->AuthorizeNet->charge($data, $payment);
                if (is_string($authorizeNet)) {
                    $this->request->data['Order']['creditcard_amount'] = '';
                    $this->request->data['Order']['creditcard_number'] = '';
                    
                    $this->Session->setFlash($authorizeNet,'default',array('class'=>'alert error_msg'));
                } else {
                    // Success
		    // Set ID to Virtual (at field or over phone)
		    $data['id'] = 'Virtual (Phone or Field)';
		    App::uses('CakeEmail', 'Network/Email');
		    $email = new CakeEmail();
		    $email->from(array('do-not-reply@leaguelaunch.com' => $site['Sites']['leaguename']))
                        ->config(array('host' => 'mail.leaguelaunch.com', 'port' => 25, 'username' => 'do-not-reply@leaguelaunch.com', 'password' => '87.~~?ZG}eI}', 'transport' => 'Smtp'))
                        ->sender(Configure::read('Settings.admin_email'))
                        ->replyTo(Configure::read('Settings.admin_email'))
                        ->cc(Configure::read('Settings.admin_email'))
                        ->to($this->request->data['Order']['cardholder_email'])
                        ->subject(Configure::read('Settings.leaguename') . ' Payment')
                        ->template('vt_credit_card_paid')
                        ->emailFormat('text')
                        ->theme('admin')
                        ->viewVars(array('order'=>$data ,'authnet' => $authorizeNet))
                        ->send();
                    $this->Session->setFlash(__('Success! Transaction:'.$authorizeNet[6].' Auth:'.$authorizeNet[4]),'default',array('class'=>'alert succes_msg'));
                    $this->redirect('/admin/sites/terminal/');
                }
                
            }
        }
        $this->set('title_for_layout','Virtual Terminal');
    }
    /**
     *   Register a Site/League
     */
    public function register(){
        
    }

}

