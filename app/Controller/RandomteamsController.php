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
                            'division_id' => $div[Divisions][division_id],
                            'name' => $pl[Players][firstname] . ' ' . $pl[Players][lastname]
                        );
                    }
                    $tmp = array();
                    foreach($player AS &$ma){
                        $tmp[] = $ma['ageindays'];
                    }
                    array_multisort($tmp,SORT_DESC, $player); 
                    $divisions[$k][Divisions]['players'] = $player;
                    
                    $teams = shuffle($div[Team]);
                    if($teams){
                        $total = count($div[Team]);
                        $i=0;
                        foreach ($player AS $p){
                            $div[Team][$i]['players'][] = $p;
                            $i++;
                            if($i==($total)){
                                $i=0;
                            }
                        }
                        $divisions[$k][Divisions]['teams'] = $div[Team];
                    }
                }
            }
        }


        $this->set(compact('divisions'));
    }

    public function admin_generate($id) {
        
    }

    public function calcage($bday) {
        $bday = new DateTime($bday);
        $today = new DateTime('00:00:00'); // for testing purposes

        $diff = $today->diff($bday);
        
        return $diff->days;
    }

}
