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

}
