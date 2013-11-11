<?php
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
