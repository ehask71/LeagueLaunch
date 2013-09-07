<?php
/**
 * CakePHP RandomteamsController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class RandomteamsController extends AppController {

    public $uses = array('Divisions','Team','PlayersToSeasons','Players');
    public function beforeFilter() {
        parent::beforeFilter();
    }
    
    public function admin_index(){
        $divisions = $this->Divisions->find('all',array(
            'conditions' => array(
                'Divisions.active' => 1,
                'Divisions.site_id' => Configure::read('Settings.site_id')
            ),
            'contain' => 'Team'
        ));
        
        $this->set(compact('divisions'));
    }
    
    public function admin_generate($id){
        
    }
    
}
