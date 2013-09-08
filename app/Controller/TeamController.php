<?php
/**
 * CakePHP TeamController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class TeamController extends AppController {
    
    public $name = 'Team';
    public $uses = array('Team','Divisions');
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index');
    }
    
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
	/*$teams = $this->Team->find('all',array(
	    'conditions' => array(
		'Team.site_id' => Configure::read('Settings.site_id')
	)));*/
        $this->paginate = array(
	    'conditions' => array(
		'Team.site_id' => Configure::read('Settings.site_id')
	)
	);
        $divisions = $this->Divisions->find('all', array(
	    'conditions' => array(
		'Divisions.site_id' => Configure::read('Settings.site_id')
	    )
        ));
	$this->set('divisions',$this->Divisions->getDivisionsDropdown());
	$this->set('teams',$this->paginate('Team'));
    }
    
    public function admin_edit($id){
        $this->Team->id = $id;
        if (!$this->Team->exists()) {
            $this->Session->setFlash(__('Team doesn\'t Exist'), 'default', array('class' => 'alert error_msg'));
            $this->redirect('/admin/team');
        }
	if($this->request->is('post') || $this->request->is('put')){
            if($this->Team->teamValidate()){
		if($this->Team->save($this->request->data)){
		    $this->Session->setFlash(__('Team Updated!'),'default',array('class'=>'alert succes_msg'));
		    $this->redirect('/admin/team');
		}
	    }
        }
        $team = $this->Team->find('first',array(
            'conditions' => array(
                'Team.team_id' => $id,
                'Team.site_id' => Configure::read('Settings.site_id')
            )
        ));
        $this->request->data = $team;
        $this->set('title',__('Edit Team'));
        $this->set('divisions',$this->Divisions->getDivisionsDropdown());
        $this->set('title_for_layout','Edit Team');
    } 
    
    
}
