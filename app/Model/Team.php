<?php
/**
 * CakePHP Team
 * @author Eric
 */
App::uses('AppModel', 'Model');

class Team extends AppModel {
    
    public $name = 'Team';
    public $primaryKey = 'team_id';
    public $belongsTo = array(
        'Divisions' => array(
            'className' => 'Divisions',
            'foreignKey' => 'division_id'
        )
    );
    
    public $hasMany = array(
        'PlayersToTeams' => array(
            'className' => 'PlayersToTeams',
            'foreignKey' => 'team_id'
        )
    );
    
    public function teamValidate(){
	
	$validate1 = array(
	    'name' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the Team name')
            ),
	    'division_id' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please select a Division')
            )
	);
	
	$this->validate = $validate1;
        return $this->validates();
    }
    
    public function getSiteTeams(){
	
    }
    
    public function getTeam($id){
        $team = $this->find('first',array(
            'conditions' => array(
                'Team.site_id' => Configure::read('Settings.site_id'),
                'Team.team_id' => $id)
        ));
        
        return $team;
    }
    
    public function getTeamPlayers($id){
        
        $sql = "SELECT Players.*,Account.* 
            FROM players_to_teams PlayersToTeams
            INNER JOIN players Players ON PlayersToTeams.player_id = Players.player_id
            INNER JOIN accounts Account ON Players.user_id = Account.id
            WHERE
                PlayersToTeams.site_id = '".Configure::read('Settings.site_id')."'
                    AND
                PlayersToTeams.team_id = '".$id."'";
        $players = $this->query($sql);
        
        return $players;
    }
}
