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
    }
    
    
    public function index(){
        
    }
    
    public function admin_index(){
        $fundraisers = $this->Fundraiser->find('all', array(
            'conditions' => array('Fundraiser.site_id'=>  Configure::read('Settings.site_id'))
        ));
        
        $this->set('fundraisers',$fundraisers);
    }
    
}

