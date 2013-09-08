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
        /*$players = $this->PlayersToSeasons->find('all',array(
            'conditions' => array(
                'PlayersToSeasons.division_id' => $div,
                'PlayersToSeasons.haspaid' => 1,
                'PlayersToSeasons.season_id' => $season,
                'PlayersToSeasons.site_id' => Configure::read('Settings.site_id')
            )
        ));*/
        $players = $this->PlayersToSeasons->query("
            SELECT Players.player_id,Players.firstname,Players.lastname,Players.league_age,Divisions.name
            FROM players_to_seasons PlayersToSeasons INNER JOIN players Players ON PlayersToSeasons.player_id = Players.player_id
            INNER JOIN divisions Divisions ON PlayersToSeasons.division_id = Divisions.division_id
            WHERE PlayersToSeasons.season_id = '".(int)$season."' AND PlayersToSeasons.division_id = '".(int)$div."'
                AND PlayersToSeasons.site_id = '".Configure::read('Settings.site_id')."' AND PlayersToSeasons.haspaid = 1
        ");
        
        $this->set('div',$div);
        $this->set('season',$season);
        $this->set('divisions',$this->Divisions->getDivisionsDropdown());
        $this->set(compact('players'));
    }
}

