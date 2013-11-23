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

    public function admin_view($id) {
	$this->loadModel('PlayersToSeasons');
	if ($this->request->is('post')) {
	    if ($this->request->data['PlayerToSeasons']['action'] == 'toggle') {
		$this->PlayersToSeasons->toggle($this->request->data['PlayerToSeasons']['id'], $this->request->data['PlayerToSeasons']['field']);
	    }
	}
	$season = $this->Season->find('first', array(
	    'recursive' => -1,
	    'conditions' => array(
		'Season.id' => $id,
		'Season.site_id' => Configure::read('Settings.site_id')
	    )
		));
	$season_total = $this->PlayersToSeasons->getSeasonTotals($id);
	$players = $this->PlayersToSeasons->getPlayersToSeason($id);

	$this->set(compact('season_total'));
	$this->set(compact('players'));
	$this->set(compact('season'));
    }

    public function admin_viewteams($id) {
	$season = $this->Season->find('first', array(
	    'recursive' => -1,
	    'conditions' => array(
		'Season.site_id' => Configure::read('Settings.site_id'),
		'Season.id' => $id
	    )
		));
	$this->loadModel('Divisions');
	$divisions = $this->Divisions->find('all', array(
	    'conditions' => array(
		'Divisions.active' => 1,
		'Divisions.site_id' => Configure::read('Settings.site_id'),
		'Divisions.season_id' => $id
	    ),
	    'contain' => array(
		'Team' => array(
		    'Team.active' => 1
	    ))
		));
	if (count($divisions) > 0) {
	    $this->loadModel('Team');
	    $i = 0;
	    foreach ($divisions AS $div) {
		if (count($div[Team]) > 0) {
		    foreach ($div[Team] AS $k => $team) {
			$divisions[$i][Team][$k][players] = $this->Team->getTeamPlayers($team[team_id]);
		    }
		}
		$i++;
	    }
	}


	$this->set(compact('divisions'));
	$this->set(compact('season'));
    }

    public function admin_editplayer($id) {
	if ($this->request->is('post')) {
	    
	}
	$this->loadModel('PlayersToSeasons');
	$player = $this->PlayersToSeasons->find('first', array(
	    'conditions' => array(
		'PlayersToSeasons.id' => $id,
		'PlayersToSeasons.site_id' => Configure::read('Settings.site_id')
	    )
		));

	$this->set(compact('player'));
    }

    public function admin_playersnotinseason($id) {
	$this->loadModel('Divisions');
	$players = $this->Season->query("SELECT 
            Players.player_id,Players.firstname,Players.lastname,Accounts.firstname,Accounts.lastname,
            Accounts.email,Accounts.phone FROM `players` Players
            INNER JOIN accounts Accounts ON Players.user_id = Accounts.id 
            LEFT JOIN players_to_seasons PlayersToSeasons ON Players.player_id = PlayersToSeasons.player_id 
            WHERE Players.site_id = " . Configure::read('Settings.site_id') . "  AND PlayersToSeasons.season_id != $id 
	    OR PlayersToSeasons.season_id IS NULL ORDER BY Players.lastname ASC");
	$division = $this->Divisions->find('all', array(
	    'conditions' => array(
		'Divisions.site_id' => Configure::read('Settings.site_id'),
		'Divisions.season_id' => $id,
		'Divisions.active' => 1
	    )
		));

	$this->set('season_id', $id);
	$this->set(compact('division'));
	$this->set(compact('players'));


/* App::uses('CakeEmail', 'Network/Email');
	  $email = new CakeEmail();
	  $email->from(array('do-not-reply@leaguelaunch.com' => Configure::read('Settings.leaguename')))
	  ->config(array('host' => 'mail.leaguelaunch.com', 'port' => 25, 'username' => 'do-not-reply@leaguelaunch.com', 'password' => '87.~~?ZG}eI}', 'transport' => 'Smtp'))
	  ->sender('playeragentebll@gmail.com')
	  ->replyTo('playeragentebll@gmail.com')
	  ->bcc(Configure::read('Settings.admin_email'))
	  ->to($player[Accounts]['email'])
	  ->subject(Configure::read('Settings.leaguename') . ' Fall Ball Inquiry')
	  ->template('player_not_in_league')
	  ->theme('admin')
	  ->emailFormat('text')
	  ->viewVars(array('player' => $player,'leaguename'=>Configure::read('Settings.leaguename')))
	  ->send(); */
    }

    public function admin_mailunpaid($id) {
	$players = $this->Season->query("SELECT 
            Players.player_id,Players.firstname,Players.lastname,Accounts.firstname,Accounts.lastname,
            Accounts.email,Accounts.phone FROM `players` Players
            INNER JOIN accounts Accounts ON Players.user_id = Accounts.id 
            LEFT JOIN players_to_seasons PlayersToSeasons ON Players.player_id = PlayersToSeasons.player_id 
            WHERE Players.site_id = " . Configure::read('Settings.site_id') . "  AND PlayersToSeasons.season_id = $id 
	    AND PlayersToSeasons.haspaid = 0 ORDER BY Players.lastname ASC");
	
	
	App::uses('CakeEmail', 'Network/Email');
	
	foreach ($players AS $player){
	$email = new CakeEmail();
	$email->from(array('do-not-reply@leaguelaunch.com' => Configure::read('Settings.leaguename')))
		->config(array('host' => 'mail.leaguelaunch.com', 'port' => 25, 'username' => 'do-not-reply@leaguelaunch.com', 'password' => '87.~~?ZG}eI}', 'transport' => 'Smtp'))
		->sender('playeragentebll@gmail.com')
		->replyTo('playeragentebll@gmail.com')
		->bcc(Configure::read('Settings.admin_email'))
		->to($player[Accounts]['email'])
		->subject(Configure::read('Settings.leaguename') . ' Fall Ball Inquiry')
		->template('player_not_paid')
		->theme('admin')
		->emailFormat('text')
		->viewVars(array('player' => $player, 'leaguename' => Configure::read('Settings.leaguename')))
		->send();
	}
	$this->Session->setFlash(__('Email Sent!'), 'default', array('class' => 'alert succes_msg'));
	$this->redirect('/admin/season');
    }
    
    public function admin_mailpaid($id) {
	$players = $this->Season->query("SELECT 
            Players.player_id,Players.firstname,Players.lastname,Accounts.firstname,Accounts.lastname,
            Accounts.email,Accounts.phone FROM `players` Players
            INNER JOIN accounts Accounts ON Players.user_id = Accounts.id 
            LEFT JOIN players_to_seasons PlayersToSeasons ON Players.player_id = PlayersToSeasons.player_id 
            WHERE Players.site_id = " . Configure::read('Settings.site_id') . "  AND PlayersToSeasons.season_id = $id 
	    AND PlayersToSeasons.haspaid = 1 ORDER BY Players.lastname ASC");
	
	
	App::uses('CakeEmail', 'Network/Email');
	
	foreach ($players AS $player){
	$email = new CakeEmail();
	$email->from(array('do-not-reply@leaguelaunch.com' => Configure::read('Settings.leaguename')))
		->config(array('host' => 'mail.leaguelaunch.com', 'port' => 25, 'username' => 'do-not-reply@leaguelaunch.com', 'password' => '87.~~?ZG}eI}', 'transport' => 'Smtp'))
		->sender('playeragentebll@gmail.com')
		->replyTo('playeragentebll@gmail.com')
		->bcc(Configure::read('Settings.admin_email'))
		->to($player[Accounts]['email'])
		->subject(Configure::read('Settings.leaguename') . ' Sorry')
		->template('player_paid')
		->theme('admin')
		->emailFormat('text')
		->viewVars(array('player' => $player, 'leaguename' => Configure::read('Settings.leaguename')))
		->send();
	}
	$this->Session->setFlash(__('Email Sent!'), 'default', array('class' => 'alert succes_msg'));
	$this->redirect('/admin/season');
    }
    
    public function admin_mailBlast(){
        $players = $this->Season->query("SELECT 
            Accounts.firstname,Accounts.lastname,Accounts.email,Accounts.phone FROM accounts Accounts 
            LEFT JOIN roles_users RoleUser ON Accounts.id = RoleUser.user_id
            WHERE RoleUser.site_id = " . Configure::read('Settings.site_id') . "  AND RoleUser.user_id = 2 ORDER BY Accounts.lastname ASC");
            //WHERE RoleUser.site_id = " . Configure::read('Settings.site_id') . "  AND RoleUser.role_id = 6 ORDER BY Accounts.lastname ASC");
        
        App::uses('CakeEmail', 'Network/Email');
	
	foreach ($players AS $player){
	$email = new CakeEmail();
	$email->from(array('do-not-reply@leaguelaunch.com' => Configure::read('Settings.leaguename')))
		->config(array('host' => 'mail.leaguelaunch.com', 'port' => 25, 'username' => 'do-not-reply@leaguelaunch.com', 'password' => '87.~~?ZG}eI}', 'transport' => 'Smtp'))
		->sender('playeragentebll@gmail.com')
		->replyTo('playeragentebll@gmail.com')
		->to($player[Accounts]['email'])
		->subject(Configure::read('Settings.leaguename') . ' Early Registration')
		->template('early_reg')
		->theme('admin')
		->emailFormat('text')
		->viewVars(array('player' => $player, 'leaguename' => Configure::read('Settings.leaguename')))
                ->attachments('/home/demoleag/public_html/app/webroot/content/'.Configure::read('Settings.site_id').'/2014-Spring-Registration-Early.docx')
		->send();
	}
    }

}
