<?php
/**
 * CakePHP SandboxController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class SandboxController extends AppController {
    
    public $name = 'Sandbox';
    public $components = array('RoundRobin');
    public $uses = array('Divisions','Team','Season','PlayersToSeasons');
    
    public function beforeFilter() {
	parent::beforeFilter();
        $this->Auth->allow();
    }
    
    public function index(){
        
    }
    
    public function testiframe(){
        
    }
    
    public function testschedule($id){
	$this->autoRender = false;
	$divisions = $this->Divisions->find('all',array(
	    'conditions' => array(
		'Divisions.active' => 1,
		'Divisions.site_id' => Configure::read('Settings.site_id'),
		'Divisions.season_id' => $id
	    )
	));
	
	foreach($divisions AS $div){
	    $teams = $this->Team->find('all',array(
		'conditions' => array(
		    'Team.division_id' =>$div['Divisions']['division_id'],
		    'Team.active' => 1,
		    'Team.site_id' => Configure::read('Settings.site_id')
		)
	    ));
    
	    $team_array = array();
	    foreach ($teams AS $team){
		$team_array[] = $team['Team']['name'];
	    }
	    //print_r($team_array);
	    //$this->RoundRobin->gameday_count = 10;
	    /*$this->RoundRobin->roundrobin($team_array);
	    $this->RoundRobin->gameday_count = 10;
	    $this->RoundRobin->create_games();*/
            $games = $this->RoundRobin->getFixtures($team_array,'2013-09-28',array('Eric','Rob','Scott'));
            //$games = $this->RoundRobin->round_robin($team_array,10);
            //$this->RoundRobin->create_raw_games();
	    echo '<b>'.$div['Divisions']['name'].'</b><br>';
	    echo '<pre>';
	   /* $games = $this->RoundRobin->games;
            $this->RoundRobin->create_games();
            $games2 = $this->RoundRobin->games;
            $games = array_merge($games,$games2);
            //$secondgames = array_reverse($this->RoundRobin->games);*/
           // print_r($games);
	    echo '</pre>';
	    $i=1;
            foreach($games AS $game){
               echo $i."<br>";
               foreach($game AS $g){
                   echo '[H] '.$g[Home].' vs '.$g[Away]."<br/>";
               }
               echo '<br>';
	       $i++;
            }
            exit();
	}
    }
    
}

