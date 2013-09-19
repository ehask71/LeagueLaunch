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
		'Divisions.season_id' => $id,
		'Divisions.name NOT LIKE' => '%Softball%'
	    )
	));
	
	foreach($divisions AS $div){
	    if(strpos($div, 'softball')){
		continue;
	    }
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
            echo '<table>';
            echo '<thead>';
            echo '<tr><th colspan="100">';
	    echo '<b>'.$div['Divisions']['name'].'</b>';
            echo '</th></tr></thead><tbody>';
	    //echo '<pre>';
            /*echo '<tr><td>Teams:<ol>';
            foreach($team_array AS $ta){
                echo '<li>'.$ta.'</li>';
            }
            echo '</ol></td></tr>';*/
	    //print_r($team_array);
            
	   /* $games = $this->RoundRobin->games;
            $this->RoundRobin->create_games();
            $games2 = $this->RoundRobin->games;
            $games = array_merge($games,$games2);
            //$secondgames = array_reverse($this->RoundRobin->games);*/
            //print_r($games[counts]);
            echo '<tr><td colspan="100">Teams:<ol>';
            foreach($games[counts] AS $k=>$v){
                echo '<li>'.$k.' ~ Games ('.$v.')</li>';
            }
            echo '</ol></td></tr>';
	    unset($games[counts]);
	    //echo '</pre>';
	    $i=1;
            foreach($games AS $game){
               //echo '<tr><td>'.$i.'</td></tr>';
               foreach($game AS $g){
                   echo '<tr>';
                   echo '<td>'.$i.'</td><td>[H] '.$g[Home].' vs '.$g[Away]."</td>";
                   echo '</tr>';
               }
               echo '<tr><td colspan="2">&nbsp;</td></tr>';
               //echo '<br>';
	       $i++;
            }
            //exit();
            echo '</tbody>';
            echo '</table>';
            echo '<br><br>';
	}
    }
    
}

