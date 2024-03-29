<?php
/**
 * CakePHP Season
 * @author Eric
 */
App::uses('AppModel', 'Model');

class Season extends AppModel {
    
    public $name = 'Season';
    public $primaryKey = 'id';
    
    public $hasMany = array(
        'PlayersToSeasons' => array(
            'className' => 'PlayersToSeasons',
	    'foreignKey' => 'season_id'
        ),
        'Divisions' => array(
            'className' => 'Divisions',
            'foreignKey' => 'season_id',
            'conditions' => array('Divisions.active' => 1),
        )
    );
    
    public function seasonValidate(){
        $validate1 = array(
            'name' => array(
		'mustNotEmpty' => array(
		    'rule' => 'notEmpty',
		    'message' => 'Please enter the Name for your Season')
	    ),
            'startdate' => array(
		'mustNotEmpty' => array(
		    'rule' => 'notEmpty',
		    'message' => 'Please enter the Season Start Date')
	    ),
            'enddate' => array(
		'mustNotEmpty' => array(
		    'rule' => 'notEmpty',
		    'message' => 'Please enter the Season End Date')
	    ),
            'registration_start' => array(
		'mustNotEmpty' => array(
		    'rule' => 'notEmpty',
		    'message' => 'Please enter the Registration Start Date')
	    ),
            'registration_end' => array(
		'mustNotEmpty' => array(
		    'rule' => 'notEmpty',
		    'message' => 'Please enter the Registration End Date')
	    )
        );
        
        $this->validate = $validate1;
        return $this->validates();
    }
    
    public function getOpenSeasons(){
        return $this->find('all',array(
            'conditions'=>array(
                'Season.site_id' => Configure::read('Settings.site_id'),
                'Season.active' => 1,
                'and' => array(
                    array('Season.registration_start <= ' => date('Y-m-d'),'Season.registration_end >= ' => date('Y-m-d'))
                )
        )));
    }
    
    public function getActiveSeasons(){
        return $this->find('all',array(
            'conditions'=>array(
                'Season.site_id' => Configure::read('Settings.site_id'),
                'Season.active' => 1,
                'and' => array(
                    array('Season.startdate <= ' => date('Y-m-d'),'Season.enddate >= ' => date('Y-m-d'))
                )
        )));
    }
    
    public function getAccountsBySeason($season){
        
    }
    
    public function checkPlayerForms($pid){
	$player = $this->find('first',array(
	   'conditions' => array(
	       'Season.active' => 1,
	       'Season.site_id' => Configure::read('Settings.site_id'),
	       'Season.enddate >' => date('Y-m-d H:i:s')
	   ),
	   'contain' => 'PlayersToSeasons.player_id = "'.$pid.'"' 
	));
	
	if($player[PlayersToSeasons][formcomplete] == 0){
	    return false;
	}
	
	return true;
    }
    
    public function checkPlayerPaid($pid){
	$player = $this->find('first',array(
	   'conditions' => array(
	       'Season.active' => 1,
	       'Season.site_id' => Configure::read('Settings.site_id'),
	       'Season.enddate >' => date('Y-m-d H:i:s')
	   ),
	   'contain' => 'PlayersToSeasons.player_id = "'.$pid.'"' 
	));
	
	if($player[PlayersToSeasons][haspaid] == 0){
	    return false;
	}
	
	return true;
    }
    
}

