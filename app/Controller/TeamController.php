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
	if ($this->request->is('post') || $this->request->is('put')) {
	    if($this->Team->teamValidate()){
		if($this->Team->save($this->request->data)){
		    $this->Session->setFlash(__('Team Added!'),'default',array('class'=>'alert succes_msg'));
		    $this->redirect('/admin/team/');
		}
	    }
	}
	$teams = $this->Team->find('all',array(
	    'conditions' => array(
		'Team.site_id' => Configure::read('Settings.site_id')
	)));
	
	$this->set('teams',$teams);
    }
    
}
