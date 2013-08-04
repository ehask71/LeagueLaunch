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
        if ($this->Season->seasonValidate()) {
            $this->Season->save($this->request->data, false);
            $this->Season->setFlash(__('The Season was Added!'), 'default', array('class' => 'alert succes_msg'));
            $this->redirect('/admin/season');
        }
        
    }

}

