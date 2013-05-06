<?php
App::uses('AppModel', 'Model');

class Keywords extends AppModel {
    
    public $useTable = 'keywords';
    
    public function getSportKeywords($sport){
        $key = $this->find('all',array('conditions' => array('Keywords.sport' => $sport)));
        
        return $key;
    }
}
?>
