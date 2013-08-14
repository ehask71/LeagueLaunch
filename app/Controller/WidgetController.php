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
        $this->Auth->allow('la','index','emailtest');
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
    
    public function emailtest(){
	$this->autoRender = false;
	App::uses('CakeEmail', 'Network/Email');
        $email = new CakeEmail();
        $email->from(array('do-not-reply@leaguelaunch.com' => Configure::read('Settings.leaguename')))
		->config(array('host'=>'mail.leaguelaunch.com','port'=>25,'username'=>'do-not-reply@leaguelaunch.com','password'=>'87.~~?ZG}eI}','transport'=>'Smtp'))
                ->sender(Configure::read('Settings.admin_email'))
                ->replyTo(Configure::read('Settings.admin_email'))
                ->cc(Configure::read('Settings.admin_email'))
                ->to('ehask71@gmail.com')
                ->subject(Configure::read('Settings.leaguename') . ' Order')
                ->template('passwd_changed')
                ->theme(Configure::read('Settings.theme'))
                ->emailFormat('text')
                ->viewVars(array('shop' => $shop))
                ->send();
    }
    
}

