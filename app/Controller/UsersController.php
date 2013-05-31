<?php

class UsersController extends AppController {

    public function beforeFilter() {
	parent::beforeFilter();
	$this->Auth->allow();
    }
    
    public function isAuthorized($user) {
        if ($user['role'] == 'admin') {
            return true;
        }
        if (in_array($this->action, array('edit', 'delete'))) {
            if ($user['id'] != $this->request->params['pass'][0]) {
                return false;
            }
        }
        return true;
    }
    
    public function login() {
	if ($this->request->is('post')) {
	    if ($this->Auth->login()) {
		$this->redirect($this->Auth->redirect());
	    } else {
		$this->Session->setFlash('Your username or password was incorrect.');
	    }
	}
    }

    public function logout() {
	$this->redirect($this->Auth->logout());
    }

}