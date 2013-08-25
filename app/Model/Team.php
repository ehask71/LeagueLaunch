<?php
/**
 * CakePHP Team
 * @author Eric
 */
App::uses('AppModel', 'Model');

class Team extends AppModel {
    
    public $name = 'Team';
    public $primaryKey = 'team_id';
    
    public function getSiteTeams(){
	
    }
}
