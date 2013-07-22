<?php
/**
 * CakePHP Forms
 * @author Eric
 */
App::uses('AppModel', 'Model');

class Forms extends AppModel {
    public $primaryKey = 'id';
    
    public function getFormsById($id){
        if (($form = Cache::read('getFormsById'.$id)) === false) {
            $form = $this->find('first', array('conditions' => array('Forms.id'=>$id,'Forms.site_id'=>  Configure::read('Settings.site_id'))));
            Cache::write('getFormsById'.$id, $form);
        }
        return $form;
    }
}

