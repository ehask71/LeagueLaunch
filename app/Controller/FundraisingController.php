<?php

/**
 * CakePHP FundraisingController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class FundraisingController extends AppController {

    public $name = 'Fundraising';
    public $uses = array('Fundraiser');
    public $helpers = array('Media.Media');

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
    
    public function admin_new() {
	if($this->request->is('post')){
	    if($this->Fundraiser->validateFundraiser()){
		if($this->Fundraiser->save($this->request->data)){
		    $this->Session->setFlash(__('New Fundraiser Added'),'default',array('class'=>'alert succes_msg'));
		    $this->redirect('/admin/fundraising');
		}
	    }
	}
    }
    
    public function admin_buyraffle($id){
	if($this->request->is('post')){
	    
	}
    }
    
    public function admin_pokerrun(){
	
    }

}

