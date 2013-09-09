<?php

/**
 * CakePHP RandomteamsController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class RandomteamsController extends AppController {

    public $uses = array('Divisions', 'Team', 'PlayersToSeasons', 'Players','RandomTeamPicks');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function admin_index() {
        
    }
    
    public function admin_baseball(){
        
    }
    
    public function admin_softball($id,$rand=FALSE){
        $divisions = $this->Divisions->find('all', array(
            'conditions' => array(
                'Divisions.active' => 1,
                'Divisions.site_id' => Configure::read('Settings.site_id'),
                'Divisions.name LIKE' => '%softball%'
            ),
            'contain' => array(
                'Team' => array(
                    'Team.active' => 1
            ))
                ));
        //mail('ehask71@gmail.com','Divisions',print_r($divisions,1));
        $sql = "SELECT Divisions.*,Team.* FROM divisions Divisions 
            LEFT JOIN teams Team ON Divisions.division_id = Team.division_id 
            WHERE Divisions.active = 1 AND Divisions.site_id = ".Configure::read('Settings.site_id')."
            AND Divisions.season_id = '".$id."'
            AND Divisions.name LIKE '%softball%'";
        
        $divisions = $this->Divisions->query($sql);
        
        foreach ($divisions AS $k => $div) {
            if (count($div['Team']) > 0) {
               
                $players = $this->PlayersToSeasons->query("SELECT 
                    PlayersToSeasons.*,Players.*
                    FROM players_to_seasons PlayersToSeasons 
                    INNER JOIN players Players ON PlayersToSeasons.player_id = Players.player_id
                    LEFT JOIN players_to_teams PlayersToTeams ON PlayersToSeasons.player_id = PlayersToTeams.player_id
                    WHERE
                    PlayersToSeasons.division_id = '" . $div[Divisions][division_id] . "'
                        AND
                    PlayersToSeasons.site_id = '" . $div[Divisions][site_id] . "'
                        AND
                    PlayersToSeasons.haspaid = 1 AND
                PlayersToTeams.player_id IS NULL");

                if (count($players) > 0) {
                    $player = array();
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
        $data = array(
            'site_id' => Configure::read('Settings.site_id'),
            'season_id' => $id,
            'key' => 'softball',
            'data' => serialize($divisions)
        );
        if($rand){
            $data['id'] = $rand;
        }
        if($this->RandomTeamPicks->save($data)){
            $this->Session->setFlash(__('Random Pick Stored'), 'default', array('class' => 'alert succes_msg'));
            $rand = $this->RandomTeamPicks->getLastInsertId();
        }
        $this->set('rand',$rand);
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
