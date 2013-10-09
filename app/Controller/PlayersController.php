<?php
/**
 * CakePHP PlayersController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class PlayersController extends AppController {
    
    public $name = 'Players';
    public $uses = array('Players','Season','Divisions');
    
    public function beforeFilter() {
	parent::beforeFilter();
    }
    
    public function admin_index(){
        $seasons = $this->Season->getActiveSeasons();
        
        $this->set(compact('seasons'));
        $this->set('title_for_layout','Manage Players');
    }
    
    public function admin_notinseason(){
	$sql = "SELECT 
		    Players.player_id,Players.firstname,Players.lastname,
		    Accounts.firstname,
		    Accounts.lastname,
		    Accounts.email,Accounts.phone 
		FROM 
		    `players` Players 
		    INNER JOIN accounts Accounts ON Players.user_id = Accounts.id 
		    LEFT JOIN players_to_seasons PlayersToSeasons ON Players.player_id = PlayersToSeasons.player_id 
		WHERE 
		    Players.site_id = ".Configure::read('Settings.site_id')." AND 
		    PlayersToSeasons.id IS NULL";
	$players = $this->Season->query($sql);
	$seasons = $this->Season->getActiveSeasons();
        
        $this->set(compact('seasons'));
	$this->set(compact('players'));
    }
    
    public function admin_division($div,$season){
        $this->loadModel('PlayersToSeasons');
        if ($this->request->is('post')) {
            //print_r($this->request->data);
            if($this->PlayersToSeasons->changePlayerDivisionBulk($this->request->data)){
                $this->Session->setFlash(__('Players Moved Successfully'),'default', array('class' => 'alert succes_msg'));
                $this->redirect('/admin/players');
            }
            $this->Session->setFlash(__('There was a problem moving players '), 'default', array('class' => 'alert error_msg'));
            //$this->redirect('/admin/players/division/'.$div.'/'.$season);
        }
        $players = $this->PlayersToSeasons->query("
            SELECT PlayersToSeasons.id,Players.player_id,Players.firstname,Players.lastname,Players.league_age,Divisions.name
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
    
    public function admin_list(){
	$options = array(
	    'conditions' => array(
		'Players.site_id' => Configure::read('Settings.site_id')
	    )
	);
	
	
	$players = $this->Players->find('all',$options);
    }
}

