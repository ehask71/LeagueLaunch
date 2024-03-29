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
        $this->Auth->allow('la', 'index', 'emailtest', 'flashtest', 'admin_checkleagueage');
    }

    public function index() {
        $this->redirect('/');
    }

    public function la($bd,$sport='baseball') {
        $this->autoRender = false;
        if ($bd != '') {
            return $this->LeagueAge->calculateLeagueAge($bd,$sport);
        }
    }

    public function emailtest() {
        $this->autoRender = false;
        App::uses('CakeEmail', 'Network/Email');
        $email = new CakeEmail();
        $email->from(array('do-not-reply@leaguelaunch.com' => Configure::read('Settings.leaguename')))
                ->config(array('host' => 'mail.leaguelaunch.com', 'port' => 25, 'username' => 'do-not-reply@leaguelaunch.com', 'password' => '87.~~?ZG}eI}', 'transport' => 'Smtp'))
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

    public function flashtest() {
        $this->Session->setFlash(__('Test For Rob'), 'alerts/info');
    }

    public function admin_checkleagueage() {
        set_time_limit(0);
        $this->loadModel('PlayersToSeasons');
        $this->loadModel('Divisions');
        $division = $this->Divisions->find('all', array(
            'conditions' => array(
                'Divisions.site_id' => Configure::read('Settings.site_id'),
                'Divisions.active' => 1
            )
                ));
        $divisions = array();
        if (count($division) > 0) {
            foreach ($division AS $d) {
                $divisions[$d[Divisions][division_id]] = $d[Divisions];
            }
        }

        $players = $this->PlayersToSeasons->query("
            SELECT PlayersToSeasons.*,Players.*,Divisions.* 
            FROM
                players_to_seasons PlayersToSeasons 
            INNER JOIN
                players Players ON PlayersToSeasons.player_id = Players.player_id
            INNER JOIN 
                divisions Divisions ON PlayersToSeasons.division_id = Divisions.division_id
            WHERE 
                PlayersToSeasons.site_id = " . Configure::read('Settings.site_id') . "
                    AND
                PlayersToSeasons.season_id = 3
        ");
        $results = array();
        $count = 0;
        foreach ($players AS $k => $p) {
            $wrongtype = 'false';
            $pos = array();
            if (stripos($p[Divisions]['name'], 'softball') !== false) {
                if ($p[Players]['gender'] == 'm') {
                    $wrongtype = 'Male in Softball';
                }
                $new = floor($this->LeagueAge->calculateLeagueAge($p[Players]['birthday'], 'softball'));
            } else {
                $new = floor($this->LeagueAge->calculateLeagueAge($p[Players]['birthday']));
            }
            if ($p[Players]['league_age'] != $new) {
                if (!in_array($new, explode(",", $p[Divisions]['age']))) {
                    $cor = 'false';
                    // Try to find proper League
                    if (stripos($p[Divisions]['name'], 'softball') !== false) {
                        foreach ($divisions AS $k => $v) {
                            if (stripos($v['name'], 'softball') === false) {
                                continue;
                            } else {
                                if (in_array($new, explode(",", $v['age']))) {
                                    $pos[] = array('division_id' => $v['division_id'], 'name' => $v['name'], 'age' => $v['age']);
                                }
                            }
                        }
                    } else {
                        foreach ($divisions AS $k => $v) {
                            if (stripos($v['name'], 'softball') !== false) {
                                continue;
                            } else {
                                if (in_array($new, explode(",", $v['age']))) {
                                    $pos[] = array('division_id' => $v['division_id'], 'name' => $v['name'], 'age' => $v['age']);
                                }
                            }
                        }
                    }
                } else {
                    $cor = 'true';
                }
                $results[$count] = array(
                    'player_id' => $p[Players]['player_id'],
                    'firstname' => $p[Players]['firstname'],
                    'lastname' => $p[Players]['lastname'],
                    'birthday' => $p[Players]['birthday'],
                    'current_la' => $p[Players]['league_age'],
                    'new_la' => $new,
                    'correctLeague' => $cor,
                    'wrongtype' => $wrongtype,
                    'currentleague' => array('division_id' => $p[Divisions]['division_id'], 'name' => $p[Divisions]['name'], 'age' => $p[Divisions]['age']),
                    'possibleleagues' => $pos
                );
               if(count($pos) <= 1){
                    //$setage = $this->PlayersToSeasons->query("UPDATE players SET league_age = '".$new."' WHERE player_id = '".$p[Players]['player_id']."'");
                    $results[$count][queries][] = "UPDATE players SET league_age = '".$new."' WHERE player_id = '".$p[Players]['player_id']."'";
                    if($cor == 'false'){
                        //$setnewdiv = $this->PlayersToSeasons->query("UPDATE players_to_seasons SET division_id = '".$pos[0][division_id]."' WHERE id='".$p[PlayersToSeasons][id]."'");
                        $results[$count][queries][] = "UPDATE players_to_seasons SET division_id = '".$pos[0][division_id]."' WHERE id='".$p[PlayersToSeasons][id]."'";
                    }
               }
               $count++;
            }
        }
        
        $this->set(compact('results'));
        $this->set(compact('players'));
    }

}

