<?php

App::uses('AppController', 'Controller');

class HomeController extends AppController {
    /* public $helpers = array('Cache');
      public $cacheAction = array(
      'index' => array('callbacks' => true, 'duration' => 48000)
      ); */

    public $name = 'Home';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'terms','privacy', 'dialog','about');
    }

    public function index() {
        //$this->Session->setFlash('Hey Rob its a Message!!','alerts/info');
    }

    public function terms() {
        
    }
    
    public function privacy() {
        
    }
    
    public function about() {
        //$content = 
    }


    public function admin_index() {
       // $this->redirect('/');
    }

    public function admin_settings() {
        $this->redirect(array('controller' => 'Sites', 'action' => 'admin_settings'));
    }

    public function notconfigured() {
        
    }

    public function dialog() {
        $this->theme = 'xinterface';
    }

}

?>
