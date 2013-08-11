<?php

App::uses('AppModel', 'Model');

class Players extends AppModel {

    public $primaryKey = 'player_id';
    public $belongsTo = array(
        'Account' => array(
            'className' => 'Account',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true,
            'counterScope' => array(),
        )
    );

    public function validatePlayer() {

        $validate1 = array(
            'firstname' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter players first name')
            ),
            'lastname' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter players last name')
            ),
            'gender' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please select player gender')
            ),
            'birthday' => array(
                'age' => array(
                    'rule' => 'checkOver3',
                    'message' => 'Player must be 3 years old or older'
                )
            )
        );

        $this->validate = $validate1;
        return $this->validates();
    }

    public function checkOver3($check) {
        $bday = strtotime($check['birthday']);
        if (time() < strtotime('+3 years', $bday))
            return false;
        return true;
    }

    public function getPlayersByUser($id, $site_id = false) {
        $conditions['Players.active'] = 1;
        $conditions['Players.user_id'] = (int) $id;
        if ($site_id) {
            $conditions['Players.site_id'] = (int) $site_id;
        }

        return $this->find('all', array(
                    'order' => 'Players.player_id DESC',
                    'conditions' => $conditions
                ));
    }

    public function getPlayerById($id, $site_id = FALSE) {
        return $this->find('first', array(
                    'conditions' => array(
                        'Players.player_id' => (int) $id
                    )
                ));
    }

    public function getPlayersToSeason($id, $active = FALSE) {
        $play = $this->find('all', array(
            'recursive' => 1,
            'conditions' => array(
                'PlayersToSeasons.season_id' => $id,
                'PlayersToSeasons.site_id' => Configure::read('Settings.site_id')
            ),
            'joins' => array(
                array(
                    'table' => 'players_to_seasons',
                    'alias' => 'PlayersToSeasons',
                    'type' => 'INNER',
                    'conditions' => array(
                        'PlayersToSeasons.player_id = Players.player_id'
                    )
                )
            )
                ));

        return $play;
    }

}

?>
