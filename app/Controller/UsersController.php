<?php

class UsersController extends AppController {

    public function beforeFilter() {
	parent::beforeFilter();
	$this->Auth->allow();
    }
    
    public function login() {

    }
    
}