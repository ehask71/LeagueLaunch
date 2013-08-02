<?php

/**
 * CakePHP ProductsToRegistrations
 * @author Eric
 */
App::uses('AppModel', 'Model');

class ProductsToRegistrations extends AppModel {

    public $primaryKey = 'id';
    public $useTable = 'products_to_registrations';

    public function getRegistrationsDropdown($regs) {
        $opts = array();
        if (count($regs) > 0) {
            foreach ($regs AS $row) {
                $products = $this->find('all', array(
                    'conditions' => array(
                        'ProductsToRegistrations.regid' => $row['Registration']['id'],
                        'ProductsToRegistrations.site_id' => $row['Registration']['site_id'],
                        'Products.active' => 1,
                        'Products.category_id' => 1
                    ),
                    'joins' => array(
                        array(
                            'table' => 'products',
                            'alias' => 'Products',
                            'type' => 'INNER',
                            'conditions' => array(
                                'ProductsToRegistrations.product_id = Products.id'
                            )
                        )
                    ),
                    'fields' => array('Products.*','ProductsToRegistrations.*')
                        ));
                if(count($products) > 0){
                    foreach ($products AS $prod){
                        $opts[$prod['Products']['id']] = $prod['Products']['name'] . ' ($' . $prod['Products']['price'] . ')';
                    }
                }
            }
            if(count($opts)>0){
                return $opts;
            }
        }
        return false;
    }

}

