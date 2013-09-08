<?php
/**
 * CakePHP PlayersController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class PlayersController extends AppController {
    
    public $name = 'Players';
    public $uses = array('Season');
    
    public function beforeFilter() {
	parent::beforeFilter();
    }
    
    public function admin_index(){
        $seasons = $this->Season->getActiveSeasons();
        
        $this->set(compact('seasons'));
        $this->set('title_for_layout','Manage Players');
    }
    
}

