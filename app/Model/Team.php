<?php
/**
 * CakePHP Team
 * @author Eric
 */
App::uses('AppModel', 'Model');

class Team extends AppModel {
    
    public $name = 'Team';
    public $primaryKey = 'team_id';
    public $belongsTo = array(
        'Division' => array(
            'className' => 'Division',
            'foreignKey' => 'division_id'
        )
    );
    
    public function teamValidate(){
	
	$validate1 = array(
	    'name' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the Team name')
            ),
	    'division_id' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please select a Division')
            )
	);
	
	$this->validate = $validate1;
        return $this->validates();
    }
    
    public function getSiteTeams(){
	
    }
}
