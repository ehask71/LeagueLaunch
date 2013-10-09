<?php

/**
 * CakePHP DivisionsController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class DivisionsController extends AppController {

    var $uses = array('Divisions');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index');
    }

    public function index() {
        $this->paginate = array(
            'conditions' => array(
                'Divisions.site_id' => Configure::read('Settings.site_id')
            )
        );
        $divisions = $this->paginate('Divisions');
        $this->set(compact('divisions'));
    }

    public function admin_index() {
        if ($this->request->is('post')) {
            if ($this->Divisions->divisionValidate()) {
                $this->Divisions->save($this->request->data, false);
                $this->Session->setFlash(__('The Division was Added!'), 'default', array('class' => 'alert succes_msg'));
                $this->redirect('/admin/divisions');
            }
        }
        $this->paginate = array(
            'conditions' => array(
                'Divisions.site_id' => Configure::read('Settings.site_id')
            )
        );
        $divisions = $this->paginate('Divisions');
        $this->set(compact('divisions'));
        $this->set('divdropdown', $this->Divisions->getDivisionsDropdown());
    }

    public function admin_delete($id) {
        $this->Divisions->id = $id;
        if (!$this->Divisions->exists()) {
            $this->Session->setFlash(__('Division doesn\'t Exist'), 'default', array('class' => 'alert error_msg'));
            $this->redirect('/admin/divisions');
        }
        if ($this->Divisions->delete()) {
            $this->Session->setFlash(__('Division Deleted'), 'default', array('class' => 'alert succes_msg'));
            $this->redirect('/admin/divisions');
        }
        $this->Session->setFlash(__('Unable To Delete Division'), 'default', array('class' => 'alert error_msg'));
        $this->redirect('/admin/divisions');
    }

    public function admin_edit($id) {
        $this->Divisions->id = $id;
        if (!$this->Divisions->exists()) {
            $this->Session->setFlash(__('Division doesn\'t Exist'), 'default', array('class' => 'alert error_msg'));
            $this->redirect('/admin/divisions');
        }
        if ($this->request->isPut()) {
            $this->Divisions->set($this->data);
            if ($this->Divisions->divisionValidate()) {
                $this->Divisions->save($this->request->data, false);
                $this->Session->setFlash(__('The Division was Updated!'), 'default', array('class' => 'alert succes_msg'));
                $this->redirect('/admin/divisions');
            }
        } else {
            $div = $this->Divisions->read(null, $id);
            $this->request->data = null;
            if (!empty($div)) {
                $this->request->data = $div;
            }
            $this->set('divdropdown', $this->Divisions->getDivisionsDropdown());
        }
    }
    
    public function admin_manageplayersteams(){
        if($this->request->is('post')){
            
        }
        $this->loadModel('Season');
        $seasons = $this->Season->getActiveSeasons();
        
        $this->set(compact('seasons'));
    }
    
    public function admin_playersteams($id, $season) {
        $division = $this->Divisions->find('first', array(
            'conditions' => array(
                'Divisions.site_id' => Configure::read('Settings.site_id'),
                'Divisions.season_id' => $season,
                'Divisions.division_id' => $id
            )
                ));
        if(is_array($division['Team'])){
            $i=0;
            foreach ($division[Team] AS $team){
                $tp = array();
                $tp = $this->Divisions->query('SELECT * FROM players_to_teams PlayersToTeams 
                    INNER JOIN players Players ON PlayersToTeams.player_id = Players.player_id
                    WHERE PlayersToTeams.season_id = ' . $season . ' AND PlayersToTeams.team_id = ' . $team[team_id].' 
                    AND PlayersToTeams.site_id = '.Configure::read('Settings.site_id'));
                $division[Team][$i]['players'] = $tp;
                $i++;
            }
        }
        
        $players = $this->Divisions->query('SELECT * FROM players_to_seasons PlayersToSeasons 
            INNER JOIN players Players ON PlayersToSeasons.player_id = Players.player_id
            LEFT JOIN players_to_teams PlayersToTeams ON PlayersToSeasons.player_id = PlayersToTeams.player_id
            WHERE PlayersToSeasons.season_id = ' . $season . ' AND PlayersToSeasons.division_id = ' . $id . ' AND PlayersToSeasons.haspaid = 1 AND
                PlayersToTeams.player_id IS NULL AND PlayersToSeasons.site_id = '.Configure::read('Settings.site_id'));
        $this->set(compact('players'));
        $this->set(compact('division'));
    }

    public function admin_updateteams() {
        $data = array();
        $req = $this->request->data;
        $season = $this->request->data['season_id'];
        unset($this->request->data['season_id']);
        if (is_array($req) && count($req) > 0) {
            foreach($req AS $k=>$v) {
                $k = str_replace("team_","",$k);
                if(is_array($v)){
                    foreach ($v AS $kk => $vv){
                        $data[$k][] = str_replace("player_","",$vv);
                    }
                }
            }
            $this->loadModel('PlayersToTeams');
            $this->PlayersToTeams->updateTeamsAjax($data,$season);
        }
        $this->set('data', $data);
        $this->render('/Elements/SerializeJson', 'ajax');
    }

}

