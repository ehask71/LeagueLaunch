<?php
/**
 * CakePHP Sports
 * @author Eric
 */
App::uses('AppModel', 'Model');

class Sports extends AppModel {
    public $useTable = false;
    
    public function getSports(){
	$sport = array(
	    '' => 'Select Your League Sport',
	    'baseball'=>'Baseball',
	    'football'=>'Football',
	    'soccer'=>'Soccer'
	);
	
	return $sport;
    }
}
