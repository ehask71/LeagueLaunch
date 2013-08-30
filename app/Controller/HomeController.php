<?php

App::uses('AppController', 'Controller');

class HomeController extends AppController {
    /* public $helpers = array('Cache');
      public $cacheAction = array(
      'index' => array('callbacks' => true, 'duration' => 48000)
      ); */

    public $name = 'Home';
    public $components = array('AuthorizeNet');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'terms', 'dialog');
    }

    public function index() {
        //$this->Session->setFlash('Hey Rob its a Message!!','alerts/info');
    }

    public function terms() {
        
    }

    public function admin_index() {
        
    }

    public function admin_settings() {
        $this->redirect(array('controller' => 'Sites', 'action' => 'admin_settings'));
    }

    public function notconfigured() {
        
    }

    public function dialog() {
        $this->theme = 'xinterface';
    }

    public function admin_terminal() {
        if ($this->request->is('post')) {
            $this->loadModel('Order');
            if ($this->Order->validateTerminal($this->request->data)) {
                $data['total'] = $this->request->data['creditcard_amount'];
                $data['first_name'] = $this->request->data['cardholder_firstname'];
                $data['last_name'] = $this->request->data['cardholder_lastname'];
                $data['billing_address'] = $this->request->data['cardholder_address'];
                $data['billing_city'] = $this->request->data['cardholder_city'];
                $data['billing_state'] = $this->request->data['cardholder_state'];
                $data['billing_zip'] = $this->request->data['cardholder_zip'];
                $data['phone'] = $this->request->data['cardholder_phone'];
                $data['email'] = $this->request->data['cardholder_email'];
                $payment['creditcard_number'] = $this->request->data['creditcard_number'];
		$payment['creditcard_month'] = $this->request->data['creditcard_month']; 
                $payment['creditcard_year'] = $this->request->data['creditcard_year'];
                $payment['creditcard_code'] = $this->request->data['creditcard_code'];
                
                $authorizeNet = $this->AuthorizeNet->charge($data, $payment);
                if (is_string($authorizeNet)) {
                    $this->request->data['creditcard_amount'] = '';
                    $this->request->data['creditcard_number'] = '';
                    
                    $this->Session->setFlash($authorizeNet);
                    //$this->redirect('/checkout/ll/' . $this->request->data['Sites']['oid'] . '-' . $this->request->data['Sites']['sid'] . '-' . base64_encode($this->request->data['Sites']['rtn']));
                    //exit();
                } else {
                    // Success
                    $this->Session->setFlash(__('Success! Transaction:'.$authorizeNet[6].' Auth:'.$authorizeNet[4]),'default',array('class'=>'alert succes_msg'));
                    $this->redirect('/admin/home/terminal/');
                }
                
            }
        }
    }

}

?>
