<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');
/**
 * CakePHP MediaController
 * @author EricMain
 */

class MediaController extends AppController {

    public $name = 'Media';
    
    public $components = array();
    
    public $uses = array('Attachment');


    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }
    
    public function admin_index(){
        
    }

}
