<?php

/**
 * CakePHP SeasonsController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class SeasonController extends AppController {

    public $name = 'Season';
    public $uses = array('Season');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function index() {
        $this->Session->setFlash(__('Oops Nothing To See Here'), 'alerts/info');
        $this->redirect('/');
    }

    public function admin_index() {
        if ($this->request->is('post')) {
            if ($this->Season->seasonValidate()) {
                $this->Season->save($this->request->data, false);
                $this->Season->setFlash(__('The Season was Added!'), 'default', array('class' => 'alert succes_msg'));
                $this->redirect('/admin/season');
            }
        }
        $this->paginate = array(
            'conditions' => array(
                'Season.site_id' => Configure::read('Settings.site_id')
            )
        );
        $seasons = $this->paginate('Season');
        $this->set(compact('seasons'));
    }

    public function admin_new() {
        if ($this->request->is('post')) {
            if ($this->Season->seasonValidate()) {
                $this->request->data['Season']['site_id'] = Configure::read('Settings.site_id');
                $this->Season->save($this->request->data, false);
                $this->Session->setFlash(__('The Season was Added!'), 'default', array('class' => 'alert succes_msg'));
                $this->redirect('/admin/season');
            }
        }

        $this->set('heading', 'New Season');
    }

    public function admin_edit($id) {
        $this->Season->id = $id;
        if (!$this->Season->exists()) {
            $this->Session->setFlash(__('Season doesn\'t Exist'), 'default', array('class' => 'alert error_msg'));
            $this->redirect('/admin/season');
        }
        if ($this->request->isPut()) {
            $this->Season->set($this->data);
            if ($this->Season->seasonValidate()) {
                $this->request->data['Season']['site_id'] = Configure::read('Settings.site_id');
                $this->Season->save($this->request->data, false);
                $this->Session->setFlash(__('The Season was Updated!'), 'default', array('class' => 'alert succes_msg'));
                $this->redirect('/admin/season');
            }
        } else {
            $div = $this->Season->read(null, $id);
            $this->request->data = null;
            if (!empty($div)) {
                $this->request->data = $div;
            }
            $this->set('heading', 'Edit Season');
            $this->render('admin_new');
        }
    }

    public function admin_view($id) {
        $this->loadModel('PlayersToSeasons');
        if ($this->request->is('post')) {
            if($this->request->data['PlayerToSeasons']['action'] == 'toggle'){
                $this->PlayersToSeasons->toggle($this->request->data['PlayerToSeasons']['id'],$this->request->data['PlayerToSeasons']['field']);
            }
        }
        $season = $this->Season->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'Season.id' => $id,
                'Season.site_id' => Configure::read('Settings.site_id')
            )
                ));
	$season_total = $this->PlayersToSeasons->getSeasonTotals($id);
        $players = $this->PlayersToSeasons->getPlayersToSeason($id);
	mail('ehask71@gmail.com','Totals',print_r($season_total,1));
	$this->set(compact('season_total'));
        $this->set(compact('players'));
        $this->set(compact('season'));
    }

    public function admin_editplayer($id) {
        if ($this->request->is('post')) {
            
        }
        $this->loadModel('PlayersToSeasons');
        $player = $this->PlayersToSeasons->find('first', array(
            'conditions' => array(
                'PlayersToSeasons.id' => $id,
                'PlayersToSeasons.site_id' => Configure::read('Settings.site_id')
            )
                ));
        
        $this->set(compact('player'));
    }

}
