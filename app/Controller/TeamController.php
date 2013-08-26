<?php
/**
 * CakePHP TeamController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class TeamController extends AppController {
    
    public $name = 'Team';
    public $uses = array('Team');
    
    public function index(){
        $teams = $this->Team->find('all',array(
	    'conditions' => array(
		'Team.site_id' => Configure::read('Settings.site_id'),
		'Team.active' => 1
	)));
	
	$this->set('teams',$teams);
    }
    
    public function admin_index(){
	$teams = $this->Team->find('all',array(
	    'conditions' => array(
		'Team.site_id' => Configure::read('Settings.site_id')
	)));
	
	$this->set('teams',$teams);
    }
    
}
