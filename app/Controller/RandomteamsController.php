<?php

/**
 * CakePHP RandomteamsController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class RandomteamsController extends AppController {

    public $uses = array('Divisions', 'Team', 'PlayersToSeasons', 'Players');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function admin_index() {
        $divisions = $this->Divisions->find('all', array(
            'conditions' => array(
                'Divisions.active' => 1,
                'Divisions.site_id' => Configure::read('Settings.site_id')
            ),
            'contain' => array(
                'Team' => array(
                    'Team.active' => 1
            ))
                ));

        foreach ($divisions AS $k => $div) {
            if (count($div['Team']) > 0) {
                $players = $this->PlayersToSeasons->find('all', array(
                    'recursive' => 1,
                    'conditions' => array(
                        'PlayersToSeasons.division_id' => $div[Divisions][division_id],
                        'PlayersToSeasons.site_id' => $div[Divisions][site_id],
                        'PlayersToSeasons.haspaid' => 1
                     ),
                    'joins' => array(
                        array(
                            'table' => 'players', //or movie_genres if you've specified it as the table to use
                            'alias' => 'Players',
                            'type' => 'INNER',
                            'conditions' => array(
                                'Players.player_id = PlayersToSeasons.player_id'
                            )
                         )
                    )
                        ));

                if (count($players)>0){
                    $divisions[$k][Divisions]['players'] = $players;
                }
            }
        }


        $this->set(compact('divisions'));
    }

    public function admin_generate($id) {
        
    }

}
