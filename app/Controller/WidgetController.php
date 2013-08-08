<?php
/**
 * CakePHP WidgetController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class WidgetController extends AppController {
    
    public $name = 'WidgetController';
    public $components = array('LeagueAge');
    
    public function beforeFilter() {
	parent::beforeFilter();
        $this->Auth->allow('la','index');
    }
    
    public function index(){
        $this->redirect('/');
    }
    
    public function la($bd){
        $this->autoRender = false;
        if($bd != ''){
            return $this->LeagueAge->calculateLeagueAge($bd);
        }
    }
    
}

