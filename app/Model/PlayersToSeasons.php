<?php
/**
 * CakePHP PlayersToSeasons
 * @author Eric
 */
App::uses('AppModel', 'Model');

class PlayersToSeasons extends AppModel {
    
    public $primaryKey = 'id';
    public $useTable = 'players_to_seasons';
    
    public function addPlayer($regid,$season_id,$player,$product_id,$opts=array()){
        $data['PlayersToSeasons'] = array();
        $data['PlayersToSeasons']['regid'] = (int)$regid;
        $data['PlayersToSeasons']['site_id'] = Configure::read('Settings.site_id');
        $data['PlayersToSeasons']['player_id'] = (int)$player;
        $data['PlayersToSeasons']['product_id'] = $product_id;
        $data['PlayersToSeasons']['haspaid'] = (isset($opts['haspaid']))?$opts['haspaid']:0;
        $data['PlayersToSeasons']['formcomplete'] = (isset($opts['haspaid']))?$opts['haspaid']:0;
        $data['PlayersToSeasons']['verifydocs'] = (isset($opts['haspaid']))?$opts['haspaid']:0;
        
        if($this->save($data)){
            return $this->getLastInsertID();
        } else {
            mail('ehask71@gmail.com', 'Add Players',' '.$regid.' '.$season_id.' '.$player.' '.$product_id );
        }
        
        return false;
    }
}

