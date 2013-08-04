<?php

App::uses('AppModel', 'Model');

class Divisions extends AppModel {

    public $primaryKey = 'division_id';

    public function divisionValidate() {
        $validate1 = array(
            'leaguename' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the League\'s Name')
            ),
        );

        $this->validate = $validate1;
        return $this->validates();
    }

    public function getDivisionsDropdown() {
        $div = $this->find('all', array(
            'conditions' => array('Divisions.site_id' => Configure::read('Settings.site_id'))));
        $opts = array();
        if(count($div)>0){
            $opts[0] = 'Choose Parent Division';
            foreach($div AS $row){
                $opts[$row['Divisions']['division_id']] =  $row['Divisions']['name'];
            }
        }
        
        return $opts;
    }

}

