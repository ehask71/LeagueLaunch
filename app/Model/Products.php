<?php

/**
 * CakePHP Products
 * @author Eric
 */
App::uses('AppModel', 'Model');

class Products extends AppModel {

    public $primaryKey = 'id';

    public function getProductById($id) {
        if (($product = Cache::read('getProductById' . $id)) === false) {
            $product = $this->find('first', array('conditions' => array('Products.id' => $id, 'Products.site_id' => Configure::read('Settings.site_id'), 'Products.active' => 1)));
            Cache::write('getProductById' . $id, $product);
        }
        return $product;
    }

    public function getProductsByDivision($div, $season = FALSE) {
        return $this->find('first', array(
                    'order' => 'Products.id DESC',
                    'conditions' => array(
                        'Products.site_id' => Configure::read('Settings.site_id'),
                        'Products.active' => 1,
                        'Products.category_id' => 1
                    ),
                    'joins' => array(
                        'table' => 'products_to_divisions',
                        'alias' => 'ProductsToDivisions',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ProductsToDivisions.product_id = Products.id',
                            'ProductsToDivisions.season_id' => Configure::read('Season.id')
                        )
                        )));
    }

    public function getRegistrationProducts() {
        return $this->find('all', array(
                    'order' => 'Products.id DESC',
                    'conditions' => array(
                        'Products.site_id' => Configure::read('Settings.site_id'),
                        'Products.active' => 1,
                        'Products.category_id' => 1
                        )));
    }

    public function getRegistrationDropDown() {
        $products = $this->find('all', array(
            'recursive' => -1,
            'order' => 'Products.id DESC',
            'conditions' => array(
                'Products.site_id' => Configure::read('Settings.site_id'),
                'Products.active' => 1,
                'Products.category_id' => 1
            ),
            'joins' => array(
                array('table' => 'products_to_registrations', 'alias' => 'ProductsToRegistrations', 'type' => 'INNER', 'conditions' => array(
                        'Products.id = ProductsToRegistrations.product_id'
                ))
                )));
        $opts = array();
        if (count($products) > 0) {
            foreach ($products AS $prod) {
                $opts[$prod['Products']['id']] = $prod['Products']['name'] . ' ($' . $prod['Products']['price'] . ')';
            }
            return $opts;
        }
        return false;
    }

    public function validateRegProduct() {
        $validate1 = array(
            'name' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter a Name')
            ),
            'price' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter a Price (9.99)')
            ),
            'description' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter a Description')
            )
        );
        $this->validate = $validate1;
        return $this->validates();
    }

}

