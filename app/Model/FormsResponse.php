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
}

