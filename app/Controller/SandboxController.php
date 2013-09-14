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
	    $this->RoundRobin->roundrobin($team_array);
	    $this->RoundRobin->create_games();
	    echo $div['Divisions']['name'].'<br>';
	    echo '<pre>';
	    print_r($this->RoundRobin->games);
	    echo '</pre>';
	}
    }
    
}

