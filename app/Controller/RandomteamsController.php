<?php

/**
 * CakePHP RandomteamsController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class RandomteamsController extends AppController {

    public $uses = array('Divisions', 'Team', 'PlayersToSeasons', 'Players');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function admin_index() {
        $divisions = $this->Divisions->find('all', array(
            'conditions' => array(
                'Divisions.active' => 1,
                'Divisions.site_id' => Configure::read('Settings.site_id')
            ),
            'contain' => array(
                'Team' => array(
                    'Team.active' => 1
            ))
                ));

        foreach ($divisions AS $k => $div) {
            if (count($div['Team']) > 0) {
                /* $players = $this->PlayersToSeasons->find('all', array(
                  'recursive' => 1,
                  'conditions' => array(
                  'PlayersToSeasons.division_id' => $div[Divisions][division_id],
                  'PlayersToSeasons.site_id' => $div[Divisions][site_id],
                  'PlayersToSeasons.haspaid' => 1
                  ),
                  'joins' => array(
                  array(
                  'table' => 'players', //or movie_genres if you've specified it as the table to use
                  'alias' => 'Players',
                  'type' => 'INNER',
                  'conditions' => array(
                  'Players.player_id = PlayersToSeasons.player_id'
                  )
                  )
                  )
                  )); */
                $players = $this->PlayersToSeasons->query("SELECT 
                    PlayersToSeasons.*,Players.*
                    FROM players_to_seasons PlayersToSeasons 
                    INNER JOIN players Players ON PlayersToSeasons.player_id = Players.player_id
                    WHERE
                    PlayersToSeasons.division_id = '" . $div[Divisions][division_id] . "'
                        AND
                    PlayersToSeasons.site_id = '" . $div[Divisions][site_id] . "'
                        AND
                    PlayersToSeasons.haspaid = 1");

                if (count($players) > 0) {
                    
                    foreach ($players AS $pl) {
                        $player[] = array(
                            'ageindays' => $this->calcage($pl[Players]['birthday']),
                            'player_id' => $pl[Players][player_id],
                            'division_id' => $pl[Players][division_id],
                            'name' => $pl[Players][firstname] . ' ' . $pl[Players][lastname]
                        );
                    }
                    $tmp = array();
                    foreach($player AS &$ma){
                        $tmp[] = $ma['ageindays'];
                    }
                    array_multisort($tmp,SORT_ASC, $player); 
                    $divisions[$k][Divisions]['players'] = $player;
                }
            }
        }


        $this->set(compact('divisions'));
    }

    public function admin_generate($id) {
        
    }

    public function calcage($bday) {
        $year = gmdate('Y');
        $month = gmdate('m');
        $day = gmdate('d');
        $dob = explode("-", $bday);

        //seconds in a day = 86400
        $days_in_between = (mktime(0, 0, 0, $month, $day, $year) - mktime(0, 0, 0, $dob[1], $dob[2], $dob[0])) / 86400;
        $age_float = $days_in_between / 365.242199; // Account for leap year
        $age = (int) ($age_float); // Remove decimal places without rounding up once number is + .5
        return $age;
    }

}
