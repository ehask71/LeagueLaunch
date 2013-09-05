<?php

/**
 * CakePHP PlayersToSeasons
 * @author Eric
 */
App::uses('AppModel', 'Model');

class PlayersToSeasons extends AppModel {

    public $primaryKey = 'id';
    public $actsAs = array('Toggleable' => array('fields'=>array('haspaid'=>array(0,1),'formcomplete'=>array(0,1),'verifydocs'=>array(0,1))));
    public $useTable = 'players_to_seasons';
    public $hasMany = array(
        'Players' => array(
            'className' => 'Players',
            'foreignKey' => 'player_id'
        ),
        'Season' => array(
            'className' => 'Season',
            'foreignKey' => 'id'
        )
    );

    public function addPlayer($season_id, $player, $div, $product_id, $opts = array()) {
        $data['PlayersToSeasons'] = array();
        $data['PlayersToSeasons']['season_id'] = (int) $season_id;
        $data['PlayersToSeasons']['site_id'] = Configure::read('Settings.site_id');
        $data['PlayersToSeasons']['player_id'] = (int) $player;
        $data['PlayersToSeasons']['division_id'] = (int) $div;
        $data['PlayersToSeasons']['product_id'] = (int) $product_id;
        $data['PlayersToSeasons']['haspaid'] = (isset($opts['haspaid'])) ? $opts['haspaid'] : 0;
        $data['PlayersToSeasons']['formcomplete'] = (isset($opts['haspaid'])) ? $opts['haspaid'] : 0;
        $data['PlayersToSeasons']['verifydocs'] = (isset($opts['haspaid'])) ? $opts['haspaid'] : 0;

        //if($this->save($data)){
        //return $this->getLastInsertID();
        //} else {
        //  mail('ehask71@gmail.com', 'Add Players',' '.$regid.' '.$season_id.' '.$player.' '.$product_id );
        //}
        return $data;
        //return false;
    }

    public function getPlayersToSeason($id, $active = FALSE) {
        $play = $this->query("
	    SELECT * FROM 
		`players_to_seasons` AS `PlayersToSeasons` 
	    INNER JOIN 
		`players` AS Players
	    ON 
		PlayersToSeasons.player_id = Players.player_id 
	    INNER JOIN
		`divisions` AS Divisions
	    ON
		PlayersToSeasons.division_id = Divisions.division_id
	    WHERE 
		PlayersToSeasons.site_id = " . Configure::read('Settings.site_id') . " 
	    AND 
		PlayersToSeasons.season_id = " . $id);

        return $play;
    }

    public function checkAlreadyRegistered($player, $id) {
        $isreg = $this->find('first', array(
            'conditions' => array(
                'PlayersToSeasons.site_id' => Configure::read('Settings.site_id'),
                'PlayersToSeasons.player_id' => $player,
                'PlayersToSeasons.season_id' => $id
            )
                ));
        if (count($isreg) > 0) {
            return true;
        }
        return false;
    }
    
    public function getSeasonTotals($id){
	$totals = $this->query("
	    SELECT season_id,
	    (SELECT COUNT(*) FROM players_to_seasons WHERE season_id = '$id' AND haspaid = 1) AS players_to_seasons.haspaid,
            (SELECT COUNT(*) FROM players_to_seasons WHERE season_id = '$id' AND haspaid = 0) AS players_to_seasons.notpaid,
	    (SELECT COUNT(*) FROM players_to_seasons WHERE season_id = '$id' ) AS players_to_seasons.total
		FROM players_to_seasons WHERE 1 LIMIT 1");
	
	return $totals;
    }
}

