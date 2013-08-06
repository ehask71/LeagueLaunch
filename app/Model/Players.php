<?php

App::uses('AppModel', 'Model');

class Players extends AppModel {

    public $primaryKey = 'player_id';
    public $belongsTo = array(
        'Account' => array(
            'className' => 'Account',
            'foreignKey' => 'id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true,
            'counterScope' => array(),
        )
    );

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

}

?>
