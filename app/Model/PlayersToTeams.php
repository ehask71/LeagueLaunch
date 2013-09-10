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
    public $belongsTo = array('Team','Players');
    
    public function updateTeamsAjax($data, $season) {
        if (is_array($data) && count($data) > 0) {
            foreach ($data AS $k => $v) {
                if (is_array($v) && count($v) > 0) {
                    foreach ($v AS $player_id) {
                        $this->query("INSERT players_to_teams 
                            SET 
                            season_id = '" . $season . "',
                            player_id = '" . $player_id . "',
                            team_id = '" . $k . "',
                            site_id='" . Configure::read('Settings.site_id') . "'
                            ON DUPLICATE KEY UPDATE
                            team_id = '".$k."'");
                    }
                }
            }
        }
    }

}

