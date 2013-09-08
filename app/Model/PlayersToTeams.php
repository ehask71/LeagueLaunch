<?php
/**
 * CakePHP PlayersToTeams
 * @author Eric
 */
App::uses('AppModel', 'Model');

class PlayersToTeams extends AppModel {
    public $name = 'PlayerstoTeams';
    public $primaryKey = 'id';
    public $useTable = 'players_to_teams';
    
    
}

