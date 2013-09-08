<?php
/**
 * CakePHP PlayersController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class PlayersController extends AppController {
    
    public $name = 'Players';
    public $uses = array('Season','Divisions');
    
    public function beforeFilter() {
	parent::beforeFilter();
    }
    
    public function admin_index(){
        $seasons = $this->Season->getActiveSeasons();
        
        $this->set(compact('seasons'));
        $this->set('title_for_layout','Manage Players');
    }
    
    public function admin_division($div,$season){
        $this->loadModel('PlayersToSeasons');
        $players = $this->PlayersToSeasons->find('all',array(
            'conditions' => array(
                'PlayersToSeasons.division_id' => $div,
                'PlayersToSeasons.haspaid' => 1,
                'PlayersToSeasons.season_id' => $season,
                'PlayersToSeasons.site_id' => Configure::read('Settings.site_id')
            )
        ));
        
        $this->set('div',$div);
        $this->set('season',$season);
        $this->set('divisions',$this->Divisions->getDivisionsDropdown());
        $this->set(compact('players'));
    }
}

