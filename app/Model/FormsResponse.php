<?php
/**
 * CakePHP FormsResponse
 * @author Eric
 */
App::uses('AppModel', 'Model');

class FormsResponse extends AppModel {
    public $primaryKey = 'id';
    public $belongsTo = array(
        'Forms' => array(
                'className' => 'Forms',
                'foreignKey' => 'form_id',
                'fields' => '',
                'order' => '',
                'counterCache' => true
            )
    );
    
    public function afterSave($created) {
        parent::afterSave($created);

        $id = ($this->getLastInsertID()) ? $this->getLastInsertID() : $this->id;
        if($id){
            Cache::delete('getResponseById'.$id);
        }
    }
    
    public function  afterDelete() {
        parent::afterDelete();

        $id = (isset($this->data['FormsResponse']['id']) && $this->data['FormsResponse']['id']) ? $this->data['FormsResponse']['id'] : $this->id;
        if($id){
            Cache::delete('getResponseById'.$id);
        }
    }
    
    public function beforeDelete(){
        parent::beforeDelete();

        $id = (isset($this->data['FormsResponse']) && $this->data['FormsResponse']['id']) ? $this->data['FormsResponse']['id'] : $this->id;

        return true;
    }

    /**
     *  Get list of question to next, prev
     *
     * @param <type> $practice_test_id
     */
    public function getResponseList($form_id=null) {
        $responseList = $this->find('list', array(
                    'order'=>array('FormsResponse.created'=>'ASC'),
                    'conditions' => array('FormsResponse.survey_id' => $form_id,'FormsResponse.site_id' => Configure::read('Settings.site_id'))
                ));
        $res = null;
        $i=0;
        foreach($responseList as $id){
            $i++;
            $res[$id] = __('Response', true).' #'.$i;
        }
        return $res;
    }
    /**
     *  Get response by id
     *
     * @param <type> $practice_test_id
     */
    public function getResponseById($id=null, $form_id=null) {

        $option = array('order'=>array('FormsResponse.created'=>'ASC'), 'fields'=>array('Forms.name', 'Forms.form_structure', 'FormsResponse.*'), 'limit'=>1);
        if($form_id){
            $option['conditions'] = array('FormsResponse.form_id' => $form_id);
        }
        if($id){
            $option = array('conditions' => array('FormsResponse.id' => $id), 'fields'=>array('Forms.name', 'Forms.form_structure','FormsResponse.*'));
        }
        $response = $this->find('first', $option);

        return $response;
    }
}

