<?php
/**
 * CakePHP WidgetController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class WidgetController extends AppController {
    
    public $name = 'Widget';
    public $components = array('LeagueAge');
    
    public function beforeFilter() {
	parent::beforeFilter();
        $this->Auth->allow('la','index','emailtest','flashtest');
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
    
    public function flashtest(){
        $this->Session->setFlash(__('Test For Rob'), 'alerts/info');
    }
           
    public function admin_checkLeagueAge(){
        $this->loadModel('PlayersToSeasons');
        
        $players = $this->PlayersToSeasons->query("
            SELECT PlayersToSeasons.*,Players.*,Divisions.* 
            FROM
                players_to_seasons PlayersToSeasons 
            INNER JOIN
                players Players ON PlayersToSeasons.player_id = Players.player_id
            INNER JOIN 
                divisions Divisions ON PlayersToSeasons.division_id = Divisions.division_id
            WHERE 
                PlayersToSeasons.site_id = ".Configure::read('Settings.site_id').",
                PlayersToSeasons.season_id = 3
        ");
        
        $this->set(compact('players'));
    }
    
}

