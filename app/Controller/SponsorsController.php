<?php
/**
 * CakePHP SponsorController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class SponsorsController extends AppController {
    
    public $name = 'Sponsors';
    public $uses = array('Products');
    
    public function beforeFilter() {
	parent::beforeFilter();
        $this->Auth->allow('index');
    }
    
    public function index(){
        
    }
    
    public function puchase(){
	$plans = $this->Products->find('all',array(
	    'conditions' => array(
		'Products.site_id' => Configure::read('Settings.site_id'),
		'Products.category_id' => 3,
		'Products.active' => 1
	    )
	));
	
	$this->set(compact('plans'));
    }
    
    public function review(){
	$shop = $this->Session->read('Shop');
	if (!$shop['Order']['total']) {
            $this->Session->setFlash(__('No Items Selected!', 'alerts/error'));
            $this->redirect('/sponsors/plans');
        }
	
	$this->set(compact('shop'));
    }
}

