<?php

/**
 * CakePHP FundraisingController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class FundraisingController extends AppController {

    public $name = 'Fundraising';
    public $uses = array('Fundraiser');

    public function beforeFilter() {
	parent::beforeFilter();
        $this->Auth->allow('index');
    }

    public function index() {
	$fundraisers = $this->Fundraiser->find('all', array(
	    'conditions' => array(
		'Fundraiser.site_id' => Configure::read('Settings.site_id'),
		'and' => array(
		    'Fundraiser.start_date <= NOW()',
		    'Fundraiser.end_date >= NOW()'
		),
		'Fundraiser.is_active' => 'yes')
		));

	$this->set('fundraisers', $fundraisers);
    }

    public function admin_index() {
	$fundraisers = $this->Fundraiser->find('all', array(
	    'conditions' => array('Fundraiser.site_id' => Configure::read('Settings.site_id'))
		));

	$this->set('fundraisers', $fundraisers);
    }
    
    public function admin_raffle() {
	
    }
    
    public function admin_buyraffle(){
	
    }
    
    public function admin_pokerrun(){
	
    }

}

