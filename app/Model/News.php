<?php

/**
 * CakePHP News
 * @author Eric
 */
App::uses('AppModel', 'Model');

class News extends AppModel {

    public $primaryKey = 'id';
    
    public $actsAs = array('Media.Media');
    
    public function newsValidate() {
	$validate1 = array(
	);

	$this->validate = $validate1;
	return $this->validates();
    }

    public function __findLatest($limit = 3) {
	return $this->find('all', array(
		    'limit' => 10,
		    'order' => 'News.id DESC',
		    'conditions' => array(
			'News.site_id' => Configure::read('Settings.site_id')
			)));
    }

}
