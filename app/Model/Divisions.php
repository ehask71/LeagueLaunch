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
    
    public function getParentDivisionsWproduct(){
        $opts = $this->find('all',array(
            'conditions' => array(
                'Divisions.active'=>1,
                'Divisions.site_id' => Configure::read('Settings.site_id'),
                "not" => array ( "ProductsToDivisions.product_id" => null)
              ),
            'joins' => array(
                array(
                    'table' => 'products_to_divisions',
                    'alias' => 'ProductsToDivisions',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Divisions.division_id = ProductsToDivisions.division_id'
                    )
                )
            ),
            'fields'=>array('Divisions.*','ProductsToDivisions.*')
        ));
        
        return $opts;
    }

}

