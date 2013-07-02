<?php
/**
 * CakePHP News
 * @author Eric
 */
App::uses('AppModel', 'Model');

class News extends AppModel {
    public $primaryKey = 'id';
    
    public function newsValidate(){
	$validate1 = array(
	    
	);
	
	$this->validate = $validate1;
        return $this->validates();
    }
}
