<?php
App::uses('AppModel', 'Model');

class Keywords extends AppModel {
    
    public $useTable = 'keywords';
    
    public function getSportKeywords($sport){
        $key = $this->find('first',array('conditions' => array('Keywords.sport' => $sport)));
        if(count($key)==0){
            $key = 'baseball,football,rugby,tennis,track,volleyball,golf';
        } else {
            $key = $key['keywords'];
        }
        return $key;
    }
}
?>
