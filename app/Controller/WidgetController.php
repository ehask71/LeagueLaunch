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
        $this->Auth->allow('leagueage','index');
    }
    
    public function index(){
        $this->redirect('/');
    }
    
    public function la($bd){
        if($bd != ''){
            return $this->LeagueAge->calculateLeagueAge($bd);
        }
    }
    
}

